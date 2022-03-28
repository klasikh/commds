<template>

  <div>
    <admin-layout>
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card px-2 py-2">
                <div class="row bg-color-blue mx-3 mb-4 py-1" style="justify-content:center; justify-items:center; content:'' ">
                  <div class="card-header">
                    <h3 class="card text-center col-lg-12 text-white" style="background-color:#4851ec"><strong>Mes demandes soumises</strong></h3>

                    <div>
                        <div class="col-12 col-sm-6 col-md-3" style="text-align:center;justify-content:center;justify-items:center;content:'';">
                            <div class="info-box">
                            <!-- <span class="info-box-icon"><i class="fas fa-users"></i></span> -->

                            <div class="info-box-content">
                                <h5>
                                    {{ requests_count }}
                                    {{ requestText }}
                                </h5>
                            </div>
                            <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>

                    </div>
                  </div>
                </div>
                <div class="card-body table-responsive p-0">
                  <table id="example1" class="table table-hover text-nowrap table-bordered table-striped">
                    <thead>
                      <tr>
                        <!-- <th class="text-capitalize">#</th> -->
                        <th class="text-capitalize">No de demande</th>
                        <th class="text-capitalize">Reference</th>
                        <th class="text-capitalize">Type de demande</th>
                        <th class="text-capitalize">Titre</th>
                        <!-- <th class="text-capitalize">Description</th> -->
                        <th class="text">Ajouté le</th>
                        <th class="text-capitalize text-center" v-if="$page.props.auth.hasRole.user">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(request, index) in requests" :key="index">
                        <td>{{ request.request_number }}</td>
                        <td>{{ request.reference }}</td>
                        <td>{{ request.request_type_id }}</td>
                        <td>{{ request.title }}</td>
                        <!-- <td>{{ request.description }}</td> -->
                        <td>{{ request.created_at }}</td>
                        <td class="text-center" v-if="$page.props.auth.hasRole.user">
                            <button class="btn btn-xs btn-primary" style="letter-spacing: 0.1em;" @click="showRequest(request)">
                                <i class="fa fa-eye"></i>
                            </button>
                            &nbsp; &nbsp;
                            <button class="btn btn-xs btn-primary" style="letter-spacing: 0.1em;" @click="editRequest(request)">
                                <i class="fa fa-pencil"></i>
                            </button>
                            &nbsp; &nbsp;
                            <button class="btn btn-xs btn-danger" @click="deleteRequest(request)">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <!-- <div class="card-footer clearfix">
                  panigation links
                </div> -->
              </div>
            </div>
          </div>
        </div>


        <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <br>
                <h2>Signature</h2>
                <hr>
                <div id="canvasDiv"></div>
                <br>
                <button type="button" class="btn btn-danger" id="reset-btn">Clear</button>
                <button type="button" class="btn btn-success" id="btn-save">Save</button>
            </div>
            <form id="signatureform" action="" style="display:none" method="post">
                <input type="hidden" id="signature" name="signature">
                <input type="hidden" name="signaturesubmit" value="1">
            </form>
        </div>
    </div>
      </section>

    </admin-layout>
  </div>
</template>

<script>
    import AdminLayout from '@/Layouts/AdminLayout'

    export default {
        props: ['requests', 'requests_count'],
        components: {
            AdminLayout,
        },
        data() {
            return {
            }
        },
        computed: {
          requestText() {
              return this.requests_count <= 1 ? 'Demande' : 'Demandes';
          },
        },
        methods: {
            editRequest(request){
                this.$inertia.get(route('user.requests.update', [request]));
            },
            showRequest(request){
                this.$inertia.get(route('user.requests.show', [request]));
            },
            deleteRequest(request){
                this.$inertia.get(route('user.requests.delete', [request]));
            },


    signPad(){
        var canvasDiv = document.getElementById('canvasDiv');
        var canvas = document.createElement('canvas');
        canvas.setAttribute('id', 'canvas');
        canvasDiv.appendChild(canvas);
        $("#canvas").attr('height', $("#canvasDiv").outerHeight());
        $("#canvas").attr('width', $("#canvasDiv").width());
        if (typeof G_vmlCanvasManager != 'undefined') {
            canvas = G_vmlCanvasManager.initElement(canvas);
        }

        context = canvas.getContext("2d");
        $('#canvas').mousedown(function(e) {
            var offset = $(this).offset()
            var mouseX = e.pageX - this.offsetLeft;
            var mouseY = e.pageY - this.offsetTop;

            paint = true;
            addClick(e.pageX - offset.left, e.pageY - offset.top);
            redraw();
        });

        $('#canvas').mousemove(function(e) {
            if (paint) {
                var offset = $(this).offset()
                //addClick(e.pageX - this.offsetLeft, e.pageY - this.offsetTop, true);
                addClick(e.pageX - offset.left, e.pageY - offset.top, true);
                console.log(e.pageX, offset.left, e.pageY, offset.top);
                redraw();
            }
        });

        $('#canvas').mouseup(function(e) {
            paint = false;
        });

        $('#canvas').mouseleave(function(e) {
            paint = false;
        });

        var clickX = new Array();
        var clickY = new Array();
        var clickDrag = new Array();
        var paint;

        function addClick(x, y, dragging) {
            clickX.push(x);
            clickY.push(y);
            clickDrag.push(dragging);
        }

        $("#reset-btn").click(function() {
            context.clearRect(0, 0, window.innerWidth, window.innerWidth);
            clickX = [];
            clickY = [];
            clickDrag = [];
        });

        $(document).on('click', '#btn-save', function() {
            var mycanvas = document.getElementById('canvas');
            var img = mycanvas.toDataURL("image/png");
            anchor = $("#signature");
            anchor.val(img);
            $("#signatureform").submit();
        });

        var drawing = false;
        var mousePos = {
            x: 0,
            y: 0
        };
        var lastPos = mousePos;

        canvas.addEventListener("touchstart", function(e) {
            mousePos = getTouchPos(canvas, e);
            var touch = e.touches[0];
            var mouseEvent = new MouseEvent("mousedown", {
                clientX: touch.clientX,
                clientY: touch.clientY
            });
            canvas.dispatchEvent(mouseEvent);
        }, false);


        canvas.addEventListener("touchend", function(e) {
            var mouseEvent = new MouseEvent("mouseup", {});
            canvas.dispatchEvent(mouseEvent);
        }, false);


        canvas.addEventListener("touchmove", function(e) {

            var touch = e.touches[0];
            var offset = $('#canvas').offset();
            var mouseEvent = new MouseEvent("mousemove", {
                clientX: touch.clientX,
                clientY: touch.clientY
            });
            canvas.dispatchEvent(mouseEvent);
        }, false);



        // Get the position of a touch relative to the canvas
        function getTouchPos(canvasDiv, touchEvent) {
            var rect = canvasDiv.getBoundingClientRect();
            return {
                x: touchEvent.touches[0].clientX - rect.left,
                y: touchEvent.touches[0].clientY - rect.top
            };
        }


        var elem = document.getElementById("canvas");

        var defaultPrevent = function(e) {
            e.preventDefault();
        }
        elem.addEventListener("touchstart", defaultPrevent);
        elem.addEventListener("touchmove", defaultPrevent);


        function redraw() {
            //
            lastPos = mousePos;
            for (var i = 0; i < clickX.length; i++) {
                context.beginPath();
                if (clickDrag[i] && i) {
                    context.moveTo(clickX[i - 1], clickY[i - 1]);
                } else {
                    context.moveTo(clickX[i] - 1, clickY[i]);
                }
                context.lineTo(clickX[i], clickY[i]);
                context.closePath();
                context.stroke();
            }
        }
    }


        }
    }
</script>

<style>
   #canvasDiv{
        position: relative;
        border: 2px dashed grey;
        height:300px;
    }
</style>

