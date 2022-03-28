var wrapper = document.getElementById("signature-pad");
var clearButton = wrapper.querySelector("[data-action=clear]");
var changeColorButton = wrapper.querySelector("[data-action=change-color]");
var undoButton = wrapper.querySelector("[data-action=undo]");
var savePNGButton = wrapper.querySelector("[data-action=save-png]");
var saveJPGButton = wrapper.querySelector("[data-action=save-jpg]");
var saveSVGButton = wrapper.querySelector("[data-action=save-svg]");
var canvas = wrapper.querySelector("canvas");
var signaturePad = new SignaturePad(canvas, {
  // It's Necessary to use an opaque color when saving image as JPEG;
  // this option can be omitted if only saving as PNG or SVG
  backgroundColor: 'rgb(255, 255, 255)'
});

// Adjust canvas coordinate space taking into account pixel ratio,
// to make it look crisp on mobile devices.
// This also causes canvas to be cleared.
function resizeCanvas() {
  // When zoomed out to less than 100%, for some very strange reason,
  // some browsers report devicePixelRatio as less than 1
  // and only part of the canvas is cleared then.
  var ratio =  Math.max(window.devicePixelRatio || 1, 1);

  // This part causes the canvas to be cleared
  canvas.width = canvas.offsetWidth * ratio;
  canvas.height = canvas.offsetHeight * ratio;
  canvas.getContext("2d").scale(ratio, ratio);

  // This library does not listen for canvas changes, so after the canvas is automatically
  // cleared by the browser, SignaturePad#isEmpty might still return false, even though the
  // canvas looks empty, because the internal data of this library wasn't cleared. To make sure
  // that the state of this library is consistent with visual state of the canvas, you
  // have to clear it manually.
  signaturePad.clear();
}

// On mobile devices it might make more sense to listen to orientation change,
// rather than window resize events.
window.onresize = resizeCanvas;
resizeCanvas();

function download(dataURL, filename) {
  if (navigator.userAgent.indexOf("Safari") > -1 && navigator.userAgent.indexOf("Chrome") === -1) {
    window.open(dataURL);
  } else {
    var blob = dataURLToBlob(dataURL);
    var url = window.URL.createObjectURL(blob);

    var a = document.createElement("a");
    a.style = "display: none";
    a.href = url;
    a.download = filename;

    document.body.appendChild(a);
    a.click();

    window.URL.revokeObjectURL(url);
  }
}

// One could simply use Canvas#toBlob method instead, but it's just to show
// that it can be done using result of SignaturePad#toDataURL.
function dataURLToBlob(dataURL) {
  // Code taken from https://github.com/ebidel/filer.js
  var parts = dataURL.split(';base64,');
  var contentType = parts[0].split(":")[1];
  var raw = window.atob(parts[1]);
  var rawLength = raw.length;
  var uInt8Array = new Uint8Array(rawLength);

  for (var i = 0; i < rawLength; ++i) {
    uInt8Array[i] = raw.charCodeAt(i);
  }

  return new Blob([uInt8Array], { type: contentType });
}

clearButton.addEventListener("click", function (event) {
  signaturePad.clear();
});

undoButton.addEventListener("click", function (event) {
  var data = signaturePad.toData();

  if (data) {
    data.pop(); // remove the last dot or line
    signaturePad.fromData(data);
  }
});

changeColorButton.addEventListener("click", function (event) {
  var r = Math.round(Math.random() * 255);
  var g = Math.round(Math.random() * 255);
  var b = Math.round(Math.random() * 255);
  var color = "rgb(" + r + "," + g + "," + b +")";

  signaturePad.penColor = color;
});

savePNGButton.addEventListener("click", function (event) {
  if (signaturePad.isEmpty()) {
    alert("Please provide a signature first.");
  } else {
    var dataURL = signaturePad.toDataURL();
    download(dataURL, "signature.png");
  }
});

saveJPGButton.addEventListener("click", function (event) {
  if (signaturePad.isEmpty()) {
    alert("Please provide a signature first.");
  } else {
    var dataURL = signaturePad.toDataURL("image/jpeg");
    download(dataURL, "signature.jpg");
  }
});

saveSVGButton.addEventListener("click", function (event) {
  if (signaturePad.isEmpty()) {
    alert("Please provide a signature first.");
  } else {
    var dataURL = signaturePad.toDataURL('image/svg+xml');
    download(dataURL, "signature.svg");
  }
});


$(function (){
    let $chatInput = $(".chat-input");
    let $chatInputToolbar = $(".chat-input-toolbar");
    let $chatBody = $(".chat-body");
    let $messageWrapper = $("#messageWrapper");


    let user_id = "{{ auth()->user()->id }}";
    let ip_address = '127.0.0.1';
    let socket_port = '8005';
    let socket = io(ip_address + ':' + socket_port);
    let friendId = "{{ $friendInfo->id }}";

    socket.on('connect', function() {
        socket.emit('user_connected', user_id);
    });

    socket.on('updateUserStatus', (data) => {
        let $userStatusIcon = $('.user-status-icon');
        $userStatusIcon.removeClass('text-success');
        $userStatusIcon.attr('title', 'Away');

        $.each(data, function (key, val) {
            if (val !== null && val !== 0) {
                let $userIcon = $(".user-icon-"+key);
                $userIcon.addClass('text-success');
                $userIcon.attr('title','Online');
            }
        });
    });

    $chatInput.keypress(function (e) {
       let message = $(this).html();
       if (e.which === 13 && !e.shiftKey) {
           $chatInput.html("");
           sendMessage(message);
           return false;
       }
    });

    function sendMessage(message) {
        let url = "{{ route('message.send-message') }}";
        let form = $(this);
        let formData = new FormData();
        let token = "{{ csrf_token() }}";

        formData.append('message', message);
        formData.append('_token', token);
        formData.append('receiver_id', friendId);

        appendMessageToSender(message);

        $.ajax({
           url: url,
           type: 'POST',
           data: formData,
            processData: false,
            contentType: false,
            dataType: 'JSON',
           success: function (response) {
               if (response.success) {
                   console.log(response.data);
               }
           }
        });
    }

    function appendMessageToSender(message) {
        let name = '{{ $myInfo->name }}';
        let image = '{!! makeImageFromName($myInfo->name) !!}';

        let userInfo = '<div class="col-md-12 user-info">\n' +
            '<div class="chat-image">\n' + image +
            '</div>\n' +
            '\n' +
            '<div class="chat-name font-weight-bold">\n' +
            name +
            '<span class="small time text-gray-500" title="'+getCurrentDateTime()+'">\n' +
            getCurrentTime()+'</span>\n' +
            '</div>\n' +
            '</div>\n';

        let messageContent = '<div class="col-md-12 message-content">\n' +
            '                            <div class="message-text">\n' + message +
            '                            </div>\n' +
            '                        </div>';


        let newMessage = '<div class="row message align-items-center mb-2">'
            +userInfo + messageContent +
            '</div>';

        $messageWrapper.append(newMessage);
    }

    function appendMessageToReceiver(message) {
        let name = '{{ $friendInfo->name }}';
        let image = '{!! makeImageFromName($friendInfo->name) !!}';

        let userInfo = '<div class="col-md-12 user-info">\n' +
            '<div class="chat-image">\n' + image +
            '</div>\n' +
            '\n' +
            '<div class="chat-name font-weight-bold">\n' +
            name +
            '<span class="small time text-gray-500" title="'+dateFormat(message.created_at)+'">\n' +
            timeFormat(message.created_at)+'</span>\n' +
            '</div>\n' +
            '</div>\n';

        let messageContent = '<div class="col-md-12 message-content">\n' +
            '                            <div class="message-text">\n' + message.content +
            '                            </div>\n' +
            '                        </div>';


        let newMessage = '<div class="row message align-items-center mb-2">'
            +userInfo + messageContent +
            '</div>';

        $messageWrapper.append(newMessage);
    }

    socket.on("private-channel:App\\Events\\PrivateMessageEvent", function (message)
    {
       appendMessageToReceiver(message);
    });

    let $addGroupModal = $("#addGroupModal");
    $(document).on("click", ".btn-add-group", function (){
        $addGroupModal.modal();
    });

    $("#selectMember").select2();
});
