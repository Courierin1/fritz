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
    <div class="container-fluid">
  <div class="row">
<br>
      <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
              <div class="box-header with-border">
                  <p>Details that apply across your events and venues</p>
              </div>
              <!-- /.box-header -->

              <form method="POST" action="" enctype="multipart/form-data">
                @csrf


                @if($errors->any())
                    <div class="alert alert-danger">
                        <p><strong>Error</strong></p>
                        <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                    </div>
                @endif
                
                
                @if(session('error'))
                    <div class="alert alert-danger">{{session('error')}}</div>
                @endif
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h2>View Organizer Profile</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Name*</label>
                                <input type="text" class="form-control" required name="name" value="{{old('name') ?? $organizer->name}}"
                                    placeholder="e.g. Neabz Careers" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>SSN/Tax ID*</label>
                                <input type="text" class="form-control" required name="tax_id" value="{{old('tax_id') ?? $organizer->tax_id}}" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Address*</label>
                                <input type="text" class="form-control" required name="address" value="{{old('address') ?? $organizer->address}}" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Bank Name*</label>
                                <input type="text" class="form-control" required name="bank_name" value="{{old('bank_name') ?? $organizer->bank_name}}" placeholder="Bank Name"disabled>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Account No*</label>
                                <input type="text" class="form-control" required name="account_no" value="{{old('account_no') ?? $organizer->account_no}}" placeholder="Account No"disabled>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Routing Nunmber*</label>
                                <input type="text" class="form-control" required name="routing_number" value="{{old('routing_number') ?? $organizer->routing_number}}" placeholder="Routing Nunmber"disabled>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Account Type*</label>
                                <input type="text" class="form-control" required name="account_type" value="{{old('account_type') ?? $organizer->account_type}}" placeholder="Account Type"disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">

                            <div class="form-group">
                                <label>Website*</label>
                                <input type="text" class="form-control" required name="website" value="{{old('website') ?? $organizer->website}}"
                                    placeholder="e.g: https://www.frimixcareers.com/home" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Organizer profile image*</label>
                                <br>
                                <img style="width: 200px!important;border-radius: 15px;height: 200px!important;object-fit: cover;" class="img-square" src="{{ asset('storage/organizer_images/'.$organizer->id.'/'.$organizer->image) }}" style="width:100px; height:100px;"
                                alt="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label>Organizer Bio*</label>
                            <p>Describe who you are, the types of events you host, or your mission. The bio is
                                displayed
                                on your organizer profile</p>
                                <div class="view_textarea_styling">
                                {!! $organizer->bio !!}
                                </div>
                        </div>
                        <div class="col-md-12">
                            <label style="margin-top:2%;">Description for event pages</label>
                            <p>Write a short description of this organizer to show on all your event
                                 pages</p>
                            <div class="view_textarea_styling">
                            {!! $organizer->description !!}
                            </div>
                        </div>
                    </div>

                </div>
                <br>
                <input type="hidden" name="organizer_id" value="{{$id}}">
            </form>


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
