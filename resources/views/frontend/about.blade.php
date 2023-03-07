@extends('layouts.frontend.frontend')
@section('title','Kathit | About')
@push('styles')
  <style>
    .about-container p {
      line-height: 2rem;
    }
    .founder img {
      width: 125px;
      position: absolute;
      /* top: -17px; */
      right: -2px;
      border-radius: 50%;
    }
    .founder-bg {
      width: 120px;
      margin: 0 auto;
      background: #d32f2f;
      height: 120px;
      border-radius: 82px;
    }
    .founder .name {
      font-weight: 600;
      color: #d32f2f;
    }
    .founder .position {
      font-weight: 600;
      color: #3d0000;
      font-size: 15px;
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
    .text-highlight {
      color: #d32f2f;
    }
    .whatwedo {
      background: #eaca9952;
    }
    .missionvision .mission,
    .missionvision .vision,
    .missionvision .values {
      border: 1px solid #3330;
      box-shadow: 0px 0px 4px 1px #d32f2f1c;
      border-radius: 5px;
    }

    .missionvision .mission img,
    .missionvision .vision img,
    .missionvision .values img{
      height: 70px;
    }

    .missionvision .mission h4,
    .missionvision .vision h4,
    .missionvision .values h4 {
      font-weight: 600;
      font-size: 18px;
      color: #d32f2f;
    }
    .whatwedo h4, .director h4 {
      color: #d32f2f;
      font-weight: 600;
    }
    .whatwedo hr, .director hr {
      border-top: 4px solid #d32f2f;
      opacity: 1;
      width: 73px;
      margin: 15px auto 25px auto;
      border-radius: 3px;
    }
    .whatwedo img {
      width: 35px;
      margin-right: 25px;
    }
    .director-cart {
      text-align: center;
      box-shadow: 1px 1px 12px 6px #d32f2f1c;
      padding: 40px 0;
      margin-top: 20px;
    }
    .director-cart img {
      width: 120px;
      height: 120px;
      border-radius: 50%;
      object-fit: cover;
      object-position: center;
      display: block;
      margin: 0 auto;
      /* border: 2px solid #d32f2f; */
    }
    .director-cart h5 {
      font-weight: bold;
      color: #d32f2f;
      margin-bottom: 0;
      margin-top: 22px;
    }

    @media screen and (max-width: 600px) {
      .title-banner .title {
        margin: 0 5%;
      }
      .title-banner .left {
        width: 60px;
      }
      .title-banner .right {
        width: 60px;
      }
      .founder-bg {
        margin-left: 33px;
      }
      .director-cart img {
        width: 100px;
        height: 100px;
      }
      .director-cart {
        padding: 25px 0;
      }
    }
  </style>
@endpush
@section('content')
  <section>
    <div class="sn-about-banner">
      <div class="position-relative">
        <div class="title-banner d-flex justify-content-center align-items-center py-2">
          <img src="{{ url('/images/icons/kanok.png') }}" alt="Kathit" class="left">
          <div class="title">
            <h3 class="mb-2 text-center">About Kathit Fashion</h3>
            <p class="mb-0 text-center">Let's Check About Our Kathit History</p>
          </div>
          <img src="{{ url('/images/icons/kanok.png') }}" alt="Kathit" class="right">
        </div>
      </div>
    </div>
    <div class="about-container p-0 my-5">
      <div class="container">
        <div class="founder row align-items-center">
          <div class="col-12 col-lg-3 mb-4 mb-lg-0">
            <div class="row text-center">
              <div class="col-5 col-lg-12 position-relative founder-bg">
                <img src="{{ url('/images/directors/kathit.jpg') }}" alt="Kathit" class="">
              </div>
              <div class="col-7 col-lg-12 ">
                <h4 class="name mt-0 mt-lg-3">Ka Thit</h4>
                <h4 class="position my-2">CEO / FOUNDER</h4>
                <span>(Fashion Designer)</span>
              </div>
            </div>
          </div>
          <div class="col-12 col-lg-9">
            <p class="text-center text-lg-start">
              ကျွန်မနှောင်းသွေး (Fashion designer) သည် small business entrepreneur အဖြစ် 2017ခုနှစ်မှ စတင်၍ Kathit Fashion လုပ်ငန်းကို 
              စတင်လုပ်ကိုင်ခဲ့ပါသည်။ Myanmar First Designer Coach တစ်ယောက်အဖြစ်နဲ့  Kathit Fashion ကို 18.6.2019 မှ စတင်၍ 
              အများနဲ့ မသက်ဆိုင်သော ကုမ္ပဏီ အဖြစ်သို့ ပြောင်းလဲ တည်ထောင်ခဲ့သည်မှာ ယခုဆိုလျင် လေးနှစ်သက်တမ်းအတွင်းသို့ ရောက်ရှိခဲ့ပြီ ဖြစ်ပါသည်။
            </p>
          </div>
        </div>
      </div>

      <div class="whatwedo my-5 py-5">
        <div class="container">
          <h4 class="text-center">WHAT WE DO</h4>
          <hr>
          <div class="d-flex justify-content-start align-items-start mb-3">
            <img src="{{ url('/images/icons/brand.png') }}" alt="Kathit" class="right">
            <div>
              <p>
                မြန်မာနိုင်ငံမှာ ပထမဆုံး customized order များကို online စနစ်ဖြင့် လက်ခံဆောင်ရွက်ပေးသော ဝန်ဆောင်မှု လုပ်ငန်းနှင့် ကိုယ်ပိုင်အမှတ်တံဆိပ်ဖြင့် 
                အမျိုးသား/ အမျိုးသမီး ဝတ်အထည်များ ထုတ်လုပ်ဖြန့်ဖြူးရောင်းချခြင်းကို  online စနစ်ဖြင့် အော်ဒါများလက်ခံပီး မြန်မာပြည်အနှံ့အပြားနှင့် 
                <span class="text-highlight">စင်္ကာပူ၊ မလေးရှား၊ထိုင်း၊အမေရိကနိုင်ငံ</span>များသို့လည်း delivery စနစ်ဖြင့် အလျင်မြန်ဆုံးပို့ဆောင်ပေးခြင်းဖြင့် Customer အများအပြား၏  စိတ်ကျေနပ်မှုအပြည့်ဖြင့် 
                ယုံကြည်အားပေးဝယ်ယူခြင်းများကို လက်ခံရရှိပီး Company ရဲ့ ပုံရိပ်ကိုလည်း တန်ဘိုးမြှင့်တက်စေခဲ့ပါသည်။ 
              </p>
            </div>
          </div>
          <div class="d-flex justify-content-start align-items-start">
            <img src="{{ url('/images/icons/brand.png') }}" alt="Kathit" class="right">
            <div>
              <p>
                ယခုအခါတွင် share ဝင် Director များထပ်မံခေါ်ယူ၍ အများပိုင်ကုမ္ပဏီအဖြစ်သို့ ပြောင်းလဲပီး အများအကျိုး customer များရဲ့အကျိုး ကို 
                ဆထက်ထမ်းပိုး လုပ်ဆောင်နိုင်ပီး ပြည်သူအများကို ကူညီထောက်ပံ့ပေးနိုင်သည့် ကုမ္ပဏီအဖြစ် ရေရှည်ရပ်တည်နိုင်ရန် ရည်ရွယ်၍ 
                အစွမ်းကုန်ကြိုးဆောင်လုပ်ဆောင်သွားမည်ဖြစ်ပါသည်။
              </p>
            </div>
          </div>
        </div>
      </div>

      <div class="missionvision container">
        <div class="row gx-0 gx-lg-5 gy-4 text-center h-100">
          <div class="col-12 col-lg-4">
            <div class="mission p-4 h-100">
              <img src="{{ url('/images/icons/Kathit-mision.png') }}" alt="Kathit" class="">
              <h4 class="my-4">OUR MISSION</h4>
              <p>
                Customer တွေရဲ့ စိတ်ချမ်းသာပျော်ရွှင်မှု နဲ့ Company မှာရှိတဲ့ လူတွေရဲ့ အနာဂတ်ကို လှပစွာ ပုံဖေါ်ထုဆစ်နိုင်ဖို့အတွက် ရည်ရွယ်ထားပီး 
                “ Now to you “ဆိုတဲ့ Kathit Fashion ရဲ့ ဆောင်ပုဒ်လေးနဲ့အညီ customer တွေရဲ့ လိုအပ်ချက်တွေကို အလျင်မြန်ဆုံး ဖြည့်ဆည်းပေးနိုင်မဲ့ 
                Kathit Fashion ဖြစ်ပါတယ်။
              </p>
            </div>
          </div>
          <div class="col-12 col-lg-4">
            <div class="vision p-4 h-100">
              <img src="{{ url('/images/icons/kathit-vision.png') }}" alt="Kathit" class="">
              <h4 class="my-4">OUR VISION</h4>
              <p>
                ဆန်းသစ် လှပမှုနဲ့ ယုံကြည်စိတ်ချရမှုကို အလျင်မြန်ဆုံး ပေးစွမ်းတာ Kathit Fashion ပါ။
              </p>
            </div>
          </div>
          <div class="col-12 col-lg-4">
            <div class="values p-4 h-100">
              <img src="{{ url('/images/icons/kathit-values.png') }}" alt="Kathit" class="">
              <h4 class="my-4">OUR VALUES</h4>
              <p>
                ဆန်းသစ် လှပမှုနဲ့ ယုံကြည်စိတ်ချရမှုကို အလျင်မြန်ဆုံး ပေးစွမ်းတာ Kathit Fashion ပါ။
              </p>
            </div>
          </div>
        </div>
      </div>

      <div class="director my-5 py-5">
        <div class="container">
          <h4 class="text-center">Our Directors</h4>
          <hr>
          <div class="row">
            <div class="col-6 col-md-3">
              <div class="director-cart">
                <img src="{{ url('images/directors/1.png') }}" alt="">
                <h5>မနီလာအောင်</h5>
                <p class="mb-0">CEO & Director</p>
              </div>
            </div>
            <div class="col-6 col-md-3">
              <div class="director-cart">
                <img src="{{ url('images/directors/2.png') }}" alt="">
                <h5>မစံစံစိုးရှိန်</h5>
                <p class="mb-0">CEO & Director</p>
              </div>
            </div>
            <div class="col-6 col-md-3">
              <div class="director-cart">
                <img src="{{ url('images/directors/3.png') }}" alt="">
                <h5>မဆုသက်လျာ</h5>
                <p class="mb-0">CEO & Director</p>
              </div>
            </div>
            <div class="col-6 col-md-3">
              <div class="director-cart">
                <img src="{{ url('images/directors/4.png') }}" alt="">
                <h5>မအေးမြခိုင်</h5>
                <p class="mb-0">CEO & Director</p>
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
