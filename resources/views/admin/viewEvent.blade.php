@extends('layouts.admin.app')


@section('content')

<style>
    .view_textarea_styling {
        border: 1px solid #eeeeee;
        border-radius: 5px;
        background-color: #eeeeee;
        padding: 5px;
    }
</style>

<section class="content">
    <div class="container-fluid"  id="event1">
  <div class="row">
<br>
      <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
           
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h2>View Event Details</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" class="form-control" required name="name" value="{{ $event->title }}"
                                    disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">

                            <div class="form-group">
                                <label>Organizer</label>
                                <input type="text" class="form-control" required name="website" value="{{ $event->organizer->name }}" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Event Image</label>
                                <br>
                                <img style="width: 200px!important;border-radius: 15px;height: 200px!important;object-fit: cover;" class="img-square" src="{{ asset($event->image ? $event->image : "assets/images/avatar/avatar.jpg") }}" style="width:100px; height:100px;"
                                alt="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="mt-3">Tickets Price</label>
                                <br>
                                @if($event->ticket_type == 'paid')
                                <input type="text" class="form-control" value="Starts at ${{$event->price}}" disabled/>
                                            @else
                                            <input type="text" class="form-control" value="Free" disabled/>
                                            @endif
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                            <h4 >Tickets Available From</h4>
                                <label> Starting From: </label>
                                <br>
        <input type="text" class="form-control" value="{{ Carbon\Carbon::parse($event->sale_start . ' ' . $event->sale_start_time)->format('M, d, Y - h:i a') }}" disabled/>
                               
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label> To: </label>
                                <br>
        <input type="text" class="form-control" value=" {{ Carbon\Carbon::parse($event->sale_end . ' ' . $event->sale_end_time)->format('M, d, Y - h:i a') }}" disabled/>
                               
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                            <h4 >Event Date and time</h4>
                                <label> Starting From: </label>
                                <br>
        <input type="text" class="form-control" value="{{ Carbon\Carbon::parse($event->event_start)->format('M, d, Y') }}, {{ ($event->display_start_time == 1) ? ' - ' . Carbon\Carbon::parse($event->start_time)->format('h:i a') : '' }}" disabled/>
                               
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label> To: </label>
                                <br>
        <input type="text" class="form-control" value="{{ Carbon\Carbon::parse($event->event_start)->format('M, d, Y') }}, {{ ($event->display_end_time == 1) ? ' - ' . Carbon\Carbon::parse($event->end_time)->format('h:i a') : '' }}" disabled/>
                               
                            </div>
                        </div>
                    </div>
                                           
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Event Type</label>
                                <br>
                                <input type="text" class="form-control" value="{{ ($event->location_type == 'venue') ? 'Venue' : 'Online Event' }}" disabled/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                            @if($event->location_type == "venue")
                            <label>Event Location Details</label>
                            <br>
                            <input type="text" class="form-control" value="{{ $event->address . ', ' . $event->state->name . ', ' . $event->city . ', ' . $event->country->name . ', ' . $event->zipcode}}" disabled/>    
                            @else
                            <label>Online Event Link</label>
                                <a href="{{ $event->event_link }}" class='poo' target="__blank">Event Link</a>
                            @endif
                                
                            </div>
                        </div>
                    </div>
                    
                                            
                                           
                    <div class="row">
                        <div class="col-md-12">
                            <label>Event Summary</label>
                            
                                <div class="view_textarea_styling">
                                {{ $event->summary  }}
                                </div>
                        </div>
                        <div class="col-md-12">
                            <label style="margin-top:2%;">Event Details</label>
                           
                            <div class="view_textarea_styling">
                            {!! $event->details !!}
                            </div>
                        </div>
                    </div>

                </div>
                <br>
                                            
          


          </div>

      </div>


  </div>



  </div>

</section>

@endsection
@section('js')
    {{-- CKEditor --}}
    <script src="https://cdn.ckeditor.com/4.17.2/standard-all/ckeditor.js"></script>

    {{-- CKEditor --}}
    <script>
        CKEDITOR.replace('editor1', {
            height: 260,
            width: 700,
            removeButtons: 'PasteFromWord'
        });
    </script>

    <script>
        CKEDITOR.replace('editor2', {
            height: 260,
            width: 700,
            removeButtons: 'PasteFromWord'
        });
    </script>

    <script>
        document.querySelectorAll(".drop-zone__input").forEach((inputElement) => {
            const dropZoneElement = inputElement.closest(".drop-zone");

            dropZoneElement.addEventListener("click", (e) => {
                inputElement.click();
            });

            inputElement.addEventListener("change", (e) => {
                if (inputElement.files.length) {
                    updateThumbnail(dropZoneElement, inputElement.files[0]);
                }
            });

            dropZoneElement.addEventListener("dragover", (e) => {
                e.preventDefault();
                dropZoneElement.classList.add("drop-zone--over");
            });

            ["dragleave", "dragend"].forEach((type) => {
                dropZoneElement.addEventListener(type, (e) => {
                    dropZoneElement.classList.remove("drop-zone--over");
                });
            });

            dropZoneElement.addEventListener("drop", (e) => {
                e.preventDefault();

                if (e.dataTransfer.files.length) {
                    inputElement.files = e.dataTransfer.files;
                    updateThumbnail(dropZoneElement, e.dataTransfer.files[0]);
                }

                dropZoneElement.classList.remove("drop-zone--over");
            });
        });

        /**
         * Updates the thumbnail on a drop zone element.
         *
         * @param {HTMLElement} dropZoneElement
         * @param {File} file
         */
        function updateThumbnail(dropZoneElement, file) {
            let thumbnailElement = dropZoneElement.querySelector(".drop-zone__thumb");

            // First time - remove the prompt
            if (dropZoneElement.querySelector(".drop-zone__prompt")) {
                dropZoneElement.querySelector(".drop-zone__prompt").remove();
            }

            // First time - there is no thumbnail element, so lets create it
            if (!thumbnailElement) {
                thumbnailElement = document.createElement("div");
                thumbnailElement.classList.add("drop-zone__thumb");
                dropZoneElement.appendChild(thumbnailElement);
            }

            thumbnailElement.dataset.label = file.name;

            // Show thumbnail for image files
            if (file.type.startsWith("image/")) {
                const reader = new FileReader();

                reader.readAsDataURL(file);
                reader.onload = () => {
                    thumbnailElement.style.backgroundImage = `url('${reader.result}')`;
                };
            } else {
                thumbnailElement.style.backgroundImage = null;
            }
        }
    </script>

<script>
  $(".copied").click(function() {
      /* Get the text field */
      var copyText = document.getElementById("event-url");

      /* Select the text field */
      copyText.select();
      copyText.setSelectionRange(0, 99999); /* For mobile devices */

      /* Copy the text inside the text field */
      navigator.clipboard.writeText(copyText.value);

  });
</script>

@endsection