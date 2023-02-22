@extends('layouts.frontend.frontend')
@section('title','Kathit | Customize')
@section('content')
  <section>
    <div class="sn-customize-banner">
      <div class="position-relative">
        <div class="title-banner d-flex justify-content-center align-items-center py-2">
          <img src="{{ url('/images/icons/kanok.png') }}" alt="Kathit" class="left">
          <div class="title">
            <h3 class="mb-0 text-center">Customize Form</h3>
          </div>
          <img src="{{ url('/images/icons/kanok.png') }}" alt="Kathit" class="right">
        </div>
      </div>
    </div>
    <div class="customize-container p-0 my-5">
      <div class="container">
        <div class="">
          <ul class="nav d-flex justify-content-center my-4 pb-1" id="myTab" role="tablist">
            <li class="nav-item me-3" role="presentation">
              <button class="active" id="dress-tab" data-bs-toggle="tab" data-bs-target="#dress" type="button" role="tab" aria-controls="dress" aria-selected="true">
                <i class="fa fa-female me-2"></i>Dress
              </button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="" id="suit-tab" data-bs-toggle="tab" data-bs-target="#suit" type="button" role="tab" aria-controls="suit" aria-selected="false">
                <i class="fa fa-male me-2"></i>Suit
              </button>
            </li>
          </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="dress" role="tabpanel" aria-labelledby="dress-tab">
              <div class="container row m-0 my-5">
                <div class="col-12 col-lg-8">
                  <img src="{{ url('/images/sizeguide/Dress.png') }}" alt="" class="dress-img mt-0 mt-lg-5">
                </div>
                <div class="col-12 col-lg-4">
                  <h4 class="mt-4 mt-lg-0">Customize Your Dress</h4>
                  <form method="post" action="{{ url('/dresscustomize') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $user_id }}">
                    <input type="hidden" name="product_id" value="{{ $product_id }}">
                    <div class="d-flex align-items-baseline measurement mb-3 mt-4">
                      <label for="measurement">
                        <span style="color: red;">*</span> Measuring by
                      </label>
                      <select name="measurement" id="measurement">
                        <option value="Centimeter" {{old('measurement',$dress->measurement)=='Centimeter' ? 'selected' : ''}}>Centimeter</option>
                        <option value="Inches" {{old('measurement',$dress->measurement)=='Inches' ? 'selected' : ''}}>Inches</option>
                      </select>
                    </div>
                    <div class="">
                      <label for="shoulder" class="d-block">Shoulder</label>
                      <input type="text" name="shoulder" id="shoulder" value="{{old('shoulder',$dress->shoulder)}}" placeholder="Fill your shoulder size" required>
                    </div>
                    <div class="">
                      <label for="chest" class="d-block">Chest</label>
                      <input type="text" name="chest" id="chest" value="{{old('chest',$dress->chest)}}" placeholder="Fill your chest size" required>
                    </div>
                    <div class="">
                      <label for="bust" class="d-block">Bust</label>
                      <input type="text" name="bust" id="bust" value="{{old('bust',$dress->bust)}}" placeholder="Fill your bust size" required>
                    </div>
                    <div class="">
                      <label for="waist" class="d-block">Waist</label>
                      <input type="text" name="waist" id="waist" value="{{old('waist',$dress->waist)}}" placeholder="Fill your waist size" required>
                    </div>
                    <div class="">
                      <label for="hips" class="d-block">Hips</label>
                      <input type="text" name="hips" id="hips" value="{{old('hips',$dress->hips)}}" placeholder="Fill your hips size" required>
                    </div>
                    <div class="">
                      <label for="neck" class="d-block">Neck</label>
                      <input type="text" name="neck" id="neck" value="{{old('neck',$dress->neck)}}" placeholder="Fill your neck size" required>
                    </div>
                    <div class="">
                      <label for="sleeve" class="d-block">Sleeve</label>
                      <input type="text" name="sleeve" id="sleeve" value="{{old('sleeve',$dress->sleeve)}}" placeholder="Fill your sleeve size" required>
                    </div>
                    <div class="">
                      <label for="length" class="d-block">Length</label>
                      <input type="text" name="length" id="length" value="{{old('length',$dress->length)}}" placeholder="Fill your dress length" required>
                    </div>
                    <div class="">
                      <label for="waist_to_floor" class="d-block">Waist to Floor</label>
                      <input type="text" name="waist_to_floor" id="waist_to_floor" value="{{old('waist_to_floor',$dress->waist_to_floor)}}" placeholder="Fill your waist to floor length" required>
                    </div>
                    <button type="submit" class="form-submit">
                      SAVE
                    </button>
                  </form>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="suit" role="tabpanel" aria-labelledby="suit-tab">
              <div class="container m-0 my-5">
                <div class="">
                  <form method="post" action="{{ url('/suitcustomize') }}" enctype="multipart/form-data" class="">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $user_id }}">
                    <input type="hidden" name="product_id" value="{{ $product_id }}">
                    <div class="row">
                      <div class="col-12 col-lg-8">
                        <img src="{{ url('/images/sizeguide/Suite-Upperbody.png') }}" alt="" class="suit-img mt-0 mt-lg-5">
                      </div>
                      <div class="col-12 col-lg-4">
                        <h4 class="mt-4 mt-lg-0">Customize Your Suit</h4>
                        <div class="d-flex align-items-baseline measurement mb-3 mt-4">
                          <label for="measurement">
                            <span style="color: red;">*</span> Measuring by
                          </label>
                          <select name="measurement" id="measurement">
                            <option value="Centimeter" {{old('measurement',$suit->measurement)=='Centimeter' ? 'selected' : ''}}>Centimeter</option>
                            <option value="Inches" {{old('measurement',$suit->measurement)=='Inches' ? 'selected' : ''}}>Inches</option>
                          </select>
                        </div>
                        <div class="">
                          <label for="shoulder" class="d-block">Shoulder</label>
                          <input type="text" name="shoulder" id="shoulder" value="{{old('shoulder',$suit->shoulder)}}" placeholder="Fill your shoulder size" required>
                        </div>
                        <div class="">
                          <label for="chest" class="d-block">Chest</label>
                          <input type="text" name="chest" id="chest" value="{{old('chest',$suit->chest)}}" placeholder="Fill your chest size" required>
                        </div>
                        <div class="">
                          <label for="neck" class="d-block">Neck</label>
                          <input type="text" name="neck" id="neck" value="{{old('neck',$suit->neck)}}" placeholder="Fill your neck size" required>
                        </div>
                        <div class="">
                          <label for="sleeve" class="d-block">Sleeve</label>
                          <input type="text" name="sleeve" id="sleeve" value="{{old('sleeve',$suit->sleeve)}}" placeholder="Fill your sleeve size" required>
                        </div>
                        <div class="">
                          <label for="top_length" class="d-block">Top Length</label>
                          <input type="text" name="top_length" id="top_length" value="{{old('top_length',$suit->top_length)}}" placeholder="Fill your Length size" required>
                        </div>
                      </div>
                    </div>
                    <hr class="my-4 my-lg-5">
                    <div class="row">
                      <div class="col-12 col-lg-8">
                        <img src="{{ url('/images/sizeguide/Suite-Lowerbody.png') }}" alt="" class="suit-img mt-0 mt-lg-5">
                      </div>
                      <div class="col-12 col-lg-4">
                        <div class="">
                          <label for="waist" class="d-block">Waist</label>
                          <input type="text" name="waist" id="waist" value="{{old('waist',$suit->waist)}}" placeholder="Fill your waist size" required>
                        </div>
                        <div class="">
                          <label for="hips" class="d-block">Hips</label>
                          <input type="text" name="hips" id="hips" value="{{old('hips',$suit->hips)}}" placeholder="Fill your hips size" required>
                        </div>
                        <div class="">
                          <label for="pants_length" class="d-block">Pants Length</label>
                          <input type="text" name="pants_length" id="pants_length" value="{{old('pants_length',$suit->pants_length)}}" placeholder="Fill your pants length size" required>
                        </div>
                        <div class="">
                          <label for="thigh_length" class="d-block">Thigh Length</label>
                          <input type="text" name="thigh_length" id="thigh_length" value="{{old('thigh_length',$suit->thigh_length)}}" placeholder="Fill your thigh length size" required>
                        </div>
                        <div class="">
                          <label for="leg_opening" class="d-block">Leg Opening</label>
                          <input type="text" name="leg_opening" id="leg_opening" value="{{old('leg_opening',$suit->leg_opening)}}" placeholder="Fill your leg opening size" required>
                        </div>
                        <div class="">
                          <label for="inseam" class="d-block">Inseam</label>
                          <input type="text" name="inseam" id="inseam" value="{{old('inseam',$suit->inseam)}}" placeholder="Fill your inseam size" required>
                        </div>
                        <button type="submit" class="form-submit">
                          SAVE
                        </button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>  
  </section>
@endsection

@push('scripts')
  <script>
    
  </script>
@endpush

@push('styles')
  <style>
    #myTab button {
      padding: 10px 20px;
      border: none;
      background: #d32f2f26;
      border-radius: 3px;
    }
    #myTab .active {
      background: #d32f2f;
      color: #fff;
    }
    #myTabContent .tab-pane {
      border: 1px solid #3330;
      box-shadow: 0px 0px 7px 1px #d32f2f26;
      border-radius: 5px;
    }
    #dress h4, #suit h4 {
      color: #3d0000;
      font-weight: 600;
    }
    #dress .dress-img, #suit .suit-img {
      width: 90%;
      display: block;
      margin: 0 auto;
    }
    #dress input[type=text], .form-submit, #dress .measurement,
    #suit input[type=text], .form-submit, #suit .measurement{
      width: 75%;
      margin-bottom: 18px;
    }
    #dress label, #suit label {
      margin-bottom: 7px;
      color: #3d0000;
      font-weight: 600;
    }
    #dress input[type=text], .measurement select,
    #suit input[type=text], .measurement select {
      border: 1px solid #3d00007a;
      background: #fff;
      border-radius: 3px;
      padding: 0 10px;
    }
    #dress input[type=text], .form-submit,
    #suit input[type=text], .form-submit{
      height: 40px;
    }
    #dress .form-submit,
    #suit .form-submit {
      background: #d32f2f;
      border: none;
      border-radius: 3px;
      margin-top: 5px;
      color: #fff;
    }
    #dress .form-submit:hover,
    #suit .form-submit:hover {
      background: #3d0000;
    }
    #dress .measurement label,
    #suit .measurement label {
      width: 40%;
    }
    #dress .measurement select,
    #suit .measurement select {
      width: 60%;
    }
    @media screen and (max-width: 600px) {
      #dress .dress-img,
      #suit .dress-img  {
        width: 100%;
      }
      #dress input[type=text], .form-submit, #dress .measurement,
      #suit input[type=text], .form-submit, #suit .measurement {
        width: 100%;
      }
      #myTabContent .tab-pane {
        border: none;
        box-shadow: none;
      }
    }

    .title-banner {
      /* height: 80px;*/
      background: #eaca9952; 
    }
    .title-banner .left {
      -webkit-transform: scaleX(-1);
      transform: scaleX(-1);
    }
    .title-banner .right {

    }
    .title-banner .title {
      margin: 0 18%;
      color: #d32f2f;
    }
    .title-banner .title h3 {
      font-weight: bold;
      margin-bottom: 5px;
    }
  </style>
@endpush
