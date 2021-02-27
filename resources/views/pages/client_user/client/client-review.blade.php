@extends('layouts.client_user.client-contentLayoutMaster')

@section('title','Client Review')

@section('page-style')
  <link href="{{asset('client_user/client/css/animate.min.css')}}" rel="stylesheet">
  <link href="{{asset('client_user/client/css/magnific-popup.css')}}" rel="stylesheet">
@endsection

@section('custom-style')
  <link href="{{asset('client_user/client/css/custom.css')}}" rel="stylesheet">
@endsection

@section('content')
  <div class="box_general">
    <div class="header_box">
      <h2 class="d-inline-block">Reviews List</h2>
      <div class="filter">
        <select name="orderby" class="selectbox">
          <option value="Any time">Any time</option>
          <option value="Latest">Latest</option>
          <option value="Oldest">Oldest</option>
        </select>
      </div>
    </div>
    <div class="list_general reviews">
      <ul>
        <li>
          <span>June 15 2019</span>
          <span class="rating"></span>
          <figure><img src="{{asset('client_user/client/img/avatar1.jpg')}}" alt=""></figure>
          <h4><small>by</small> M.Twain</h4>
          <p>Lorem ipsum dolor sit amet, dolores mandamus moderatius ea ius, sed civibus vivendum imperdiet ei, amet tritani sea id. Ut veri diceret fierent mei, qui facilisi suavitate euripidis ad. In vim mucius menandri convenire, an brute zril vis. Ancillae delectus necessitatibus no eam, at porro solet veniam mel, ad everti nostrud vim. Eam no menandri pertinacia deterruisset.</p>
          <p class="inline-popups"><a href="#modal-reply" data-effect="mfp-zoom-in" class="btn_1 gray"><i class="fa fa-fw fa-reply"></i> Reply to this review</a></p>
        </li>
        <li>
          <span>June 15 2019</span>
          <span class="rating"></span>
          <figure><img src="{{asset('client_user/client/img/avatar2.jpg')}}" alt=""></figure>
          <h4><small>by</small> M.Giuliani</h4>
          <p>Ex omnis error aliquam quo, eu eos atqui accusam, ex nec sensibus erroribus principes. No pro albucius eloquentiam accommodare. Mei id illud posse persius. Nec eu dico lucilius delicata, qui propriae voluptaria eu.</p>
          <p class="inline-popups"><a href="#modal-reply" data-effect="mfp-zoom-in" class="btn_1 gray"><i class="fa fa-fw fa-reply"></i> Reply to this review</a></p>
        </li>
        <li>
          <span>June 15 2019</span>
          <span class="rating"></span>
          <figure><img src="{{asset('client_user/client/img/avatar3.jpg')}}" alt=""></figure>
          <h4><small>by</small> G.Lukas</h4>
          <p>Cum id mundi admodum menandri, eum errem aperiri at. Ut quas facilis qui, euismod admodum persequeris cum at. Summo aliquid eos ut, eum facilisi salutatus ne. Mazim option abhorreant ne his. Mel simul iisque albucius at, probatus indoctum efficiendi mei ei. Veniam percipit ei sea.</p>
          <p class="inline-popups"><a href="#modal-reply" data-effect="mfp-zoom-in" class="btn_1 gray"><i class="fa fa-fw fa-reply"></i> Reply to this review</a></p>
        </li>
      </ul>
    </div>
  </div>
  <!-- /box_general-->
  <nav aria-label="...">
    <ul class="pagination pagination-sm add_bottom_30">
      <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1">Previous</a></li>
      <li class="page-item"><a class="page-link" href="#">1</a></li>
      <li class="page-item"><a class="page-link" href="#">2</a></li>
      <li class="page-item"><a class="page-link" href="#">3</a></li>
      <li class="page-item"><a class="page-link" href="#">Next</a></li>
    </ul>
  </nav>
  <!-- /pagination-->
  <!-- Reply to review popup -->
  <div id="modal-reply" class="white-popup mfp-with-anim mfp-hide">
    <div class="small-dialog-header">
      <h3>Reply to review</h3>
    </div>
    <div class="message-reply margin-top-0">
      <div class="form-group">
        <textarea cols="40" rows="3" class="form-control"></textarea>
      </div>
      <button class="btn_1">Reply</button>
    </div>
  </div>
@endsection

@section('page-script')
  <script src="{{asset('vendors/js/forms/validation/jquery.validate.min.js')}}"></script>
  <script src="{{asset('client_user/client/js/page-scripts/client-review.js')}}"></script>
@endsection
