<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>Driveluxe - Luxury Car Rental</title>
    <!-- ============  Google Font =========== -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-dist/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
          integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />


    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/owl.carousel@2.3.4/dist/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/owl.carousel@2.3.4/dist/assets/owl.theme.default.min.css">
    @yield('before_main_style')
    <!-- ==== CSS ========= -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.css" />
    @yield('styles')
    <style>

        .daterangepicker {
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            font-family: 'Inter', sans-serif; /* Use a modern font for better UX */
            padding: 20px;
            background-color: #fff;
        }

        /* Header styling for months */
        .daterangepicker .drp-calendar.left .month,
        .daterangepicker .drp-calendar.right .month {
            font-weight: bold;
            font-size: 16px;
            text-align: center;
            margin-bottom: 15px;
            color: #000;
        }

        .daterangepicker .drp-calendar {
            max-width: 50% !important;
        }

        /* Weekdays styling */
        .daterangepicker .calendar-table thead tr th {
            font-size: 14px;
            color: #888;
            text-transform: uppercase;
        }

        /* Day numbers styling */
        .daterangepicker .calendar-table tbody tr td {
            width: 50px;
            height: 48px;
            line-height: 40px;
            text-align: center;
            font-size: 14px;
            color: #333;
            border-radius:0;
            cursor: pointer;
        }

        /* Highlighted selected range */
        .daterangepicker .in-range {
            background-color: #d1e6ff; /* Blue highlight for the range */
            color: #000;
            border-radius: 0; /* Keep inner dates rectangle-like */
        }

        .deatils-slides {
            position: absolute;
            top: 72px;
            left: 0px;
            background: #FFFFFF;
            padding: 20px 20px;
            margin-top: 16px !important;
            min-width: 294px;
            height: 310px;
            border-radius: 0px;
        }
        .deatils-slides ul {
            padding: 0px;
            margin: 0px;
            list-style: none;
        }

        .owl-stage-outer .owl-stage {
            height: 100%;
        }

        /* Highlighted start and end dates */
        .daterangepicker .start-date,
        .daterangepicker .end-date {
            background-color: #3c82f6; /* Darker blue for start and end */
            color: #fff;
            border-radius: 50%;
        }

        /* Hover effect on dates */
        .daterangepicker .calendar-table tbody tr td:hover {
            background-color: #f1f7ff;
            color: #000;

            width: 45px;
            height: 45px;
            line-height: 40px;
            text-align: center;
            font-size: 14px;


        }


            /* Disabled dates */
        .daterangepicker .off,
        .daterangepicker .off:hover {
            color: #ccc;
            background-color: transparent;
            cursor: not-allowed;
        }

        .daterangepicker {
            top: 612.3px;
            left: 219px;
            width: 800px;
        }


        /* Time picker section styling */
        .daterangepicker .drp-time {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 10px;
        }

        .daterangepicker select {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 5px 10px;
            font-size: 14px;
            outline: none;
            background-color: #f9f9f9;
            cursor: pointer;
        }

        /* Apply and Cancel buttons */
        .daterangepicker .drp-buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .daterangepicker .drp-buttons button {
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 14px;
            cursor: pointer;
            outline: none;
            transition: all 0.3s ease;
        }


        .daterangepicker .drp-buttons .applyBtn {
            background-color: #3c82f6;
            color: #fff;
            padding: 10px 22px;
            border-radius: 20px;
        }

        .daterangepicker .drp-buttons .applyBtn:hover {
            background-color: #2b63c4;
        }

        .daterangepicker .drp-buttons .cancelBtn {
            background-color: #f1f1f1;
            color: #333;
            padding: 10px 20px;
            border-radius: 20px;
        }

        .daterangepicker .drp-buttons .cancelBtn:hover {
            background-color: #ddd;
        }
        .drp-selected {
            display: none !important;
        }

        .date-picker {
            background: #FFFFFF;
            /* border: 1px solid #DEDEDE; */
            box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.08), 0px 4px 12px rgba(0, 0, 0, 0.05);
            border-radius: 70px;

            display: flex;
            justify-content: center;
            align-items: center;
        }
        .custom-card-icons {
            flex-wrap:wrap;
        }

        .daterangepicker td.start-date.end-date {
            /* border-radius: 4px; */
            color: white;
            font-size: 15px;
            background: black;
           border-radius:0;
            padding: 0px 14px;
            font-weight: 600;
        }

        .daterangepicker td.in-range {
            background:#F4F4F9;
            color:black;
            font-size: 15px;
            padding: 0px 0px;
            font-weight: 600;
        }
        .daterangepicker td.active, .daterangepicker td.active:hover {
            background-color: black !important;
            border-color: transparent ;
            color: white !important;
            border-bottom-right-radius: 0;
            border-top-right-radius: 0;
        }
        .active.end-date, .active.start-date {
            border-radius:0px;

        }



        .daterangepicker.show-calendar.opensright {
            /*top: 350.1px;*/
            /*left: 220px !important;*/
            /* right: 0px; */

        }
        .table-condensed thead tr th {
            font-weight: bold;
            font-size: 18px;
            text-align: center;
            margin-bottom: 15px;
            color: #000;
            padding-bottom: 15px;
        }
        .daterangepicker .calendar-table thead tr th {
            padding-bottom: 17px;
        }

        .secondary-exp-carousel .owl-dots {
            color: white;
            width: 100px;
            position: absolute;
            bottom: 10px;
        }

        .secondary-exp-carousel .owl-dots .owl-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            margin: 3px;
            background:gray;
        }
        .secondary-exp-carousel .owl-dots .active {
            background:white;
        }

    </style>
</head>

<body>



@yield('header')


@yield('content')


<footer class="py-5" style="background-color: #1A1A1A;">
    <div class="container footermain-links-container my-4">
        <div class="row">
            <div class="col-12">
                <div class="row mb-5 d-flex justify-content-between align-items-center">
                    <div class=" w-50 footer-logo">
                        <a href="#"><img width="200px" src="{{ asset('assets/image/Driveluxe_Logo_White_Update2022_300dpi_Transparent.png') }}"  />
                        </a>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-12 col-md-6 col-lg-4">
                <div class="footer-link-list">
                    <h4>What we offer</h4>
                    <ul class="footer-links-ul"><!--
                        <li class="list-item "><a href="#">DRIVELUXE car subscription</a></li>
                        <li class="list-item "><a href="#">DRIVELUXE ride</a></li>
                        <li class="list-item "><a href="#">car rental</a></li>
                        <li class="list-item "><a href="#">truck rental</a></li>
                        <li class="list-item "><a href="#">station search</a></li>
                        <li class="list-item "><a href="#">DRIVELUXE Status Program</a></li>
                        <li class="list-item "><a href="#">Top Offers</a></li>
                        -->
                    </ul>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-lg-4">
                <div class="footer-link-list">
                    <h4>DRIVELUXE for our business customers</h4>
                    <ul class="footer-links-ul">
                        <li class="list-item "><a href="#">Send inquiry</a></li>
                        <li class="list-item "><a href="#">Long time rentals</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-lg-4">
                <div class="footer-link-list">
                    <h4>Help and more</h4>
                    <ul class="footer-links-ul">

                        <li class="list-item "><a href="#">Help</a></li>
                        <li class="list-item "><a href="#">rental information</a></li>

                    </ul>
                </div>
            </div>
        </div>

    </div>


    <div class="container">
        <div class="row">
            <div class="footer-lower-links">
                <ul class="f-lower-link">
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Terms and Conditions</a></li>
                    <li><a href="#">About us</a></li>
                    <li><a href="#">All about Cookies</a></li>

                </ul>

                <p class="mt-4 mt-sm-4 mt-md-0 mt-lg-0 mt-xl-0">© DRIVELUXE 2025</p>
            </div>
        </div>
    </div>
</footer>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content border-0 border-black shadow-lg ">
            <div class="modal-header border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" >

                </button>
            </div>
            <div class="modal-body pt-4 pb-5 px-5" id="price_details">

            </div>
        </div>
    </div>
</div>

<div class="modal login-model fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true"
     style="display: none;">
    @php
        $currentUrl = url()->current();
        $queryString = request()->getQueryString();
        $fullUrl = $currentUrl . ($queryString ? '?' . $queryString : '');
    @endphp
    <div class="modal-dialog">
        <div class="modal-content ">
            <div class="modal-header" style="padding:0;border-bottom: 0;">

                <div class="login-container py-4 bg-white rounded shadow p-4" style="width: 100%;">
                    <i class="fa-solid fa-xmark login-popup-close-icon " class="btn-close"
                       data-bs-dismiss="modal" aria-label="Close" style="cursor: pointer;"></i>
                    <h3 class="mb-4 pb-2 mt-3">Log in or register</h3>

                    <a href="{{ route('social.login',['provider'=>'apple','redirect_to'=>$fullUrl]) }}" class="btn googlebtn w-100 mb-3">
                        <span class="login-icons"><img src="{{ asset('assets/image/apple-img.png') }}" width="40px" /></span>
                        Continue with Apple
                    </a>

                    <a href="{{ route('social.login',['provider'=>'google','redirect_to'=>$fullUrl]) }}" class="btn googlebtn w-100">
                        <span class="login-icons"><img src="{{ asset('assets/image/gogle-img.png') }}" width="40px" /></span>
                        Continue with Google
                    </a>

                    <div class="text-center text-secondary my-3">or</div>

                    <form>
                        <div class="mb-3 position-relative">
                            <div class="form-floating">
                                <input type="email" class="form-control floating-email-input" id="email"
                                       placeholder="Email">
                                <label for="floatingPassword">Email</label>
                            </div>
                            <img src="{{ asset('assets/image/login-info-icon.png') }}" width="30px" class="login-info-icon" />
                        </div>
                        <div id="userExist" style="display: none">
                            <div class="mb-3 position-relative" >
                                <div class="form-floating">
                                    <input type="password" class="form-control floating-email-input" id="password"
                                           placeholder="password">
                                    <label for="floatingPassword">Password</label>
                                </div>
                                <img src="{{ asset('assets/image/login-info-icon.png') }}" width="30px" class="login-info-icon" />
                            </div>
                            <button type="button" id="LoginBtn" onclick="loginUser()" class="btn btn-login-submit w-100 mb-3">Login</button>
                        </div>

                        <div id="userNotExist" style="display: none">
                            <div class="mb-3 position-relative" >
                                <div class="form-floating">
                                    <input type="text" class="form-control floating-email-input" id="name"
                                           placeholder="Name">
                                    <label for="floatingPassword">Name</label>
                                </div>
                            </div>
                            <div class="mb-3 position-relative">
                                <div class="form-floating">
                                    <input type="password" class="form-control floating-email-input"
                                           id="password12"
                                           placeholder="Enter Password" autocomplete="new-password">
                                    <label for="password">Password</label>
                                </div>
                            </div>

                            <div class="mb-3 position-relative">
                                <div class="form-floating">
                                    <input type="password" class="form-control floating-email-input"
                                           id="password_confirmation" name="password_confirmation"
                                           placeholder="Confirm Password" autocomplete="new-password">
                                    <label for="password_confirmation">Confirm Password</label>
                                </div>
                            </div>
                            <button type="button" id="registerBtn" onclick="registerUser()" class="btn btn-login-submit w-100 mb-3">Register</button>
                        </div>

                        <button type="button" id="furtherButton" onclick="checkUser()" class="btn btn-login-submit w-100 mb-3">Further</button>
                    </form>

                    <p class="text-center asked-already-reg">
                        No company rate yet? <a href="#" class="">Register your company now</a>
                    </p>

                    <div class="d-flex justify-content-center mt-4 pb-4">
                        <a href="#" class=" me-3">Terms and Conditions</a>
                        <a href="#" class="text-muted">Privacy Policy</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{ asset('assets/css/bootstrap-dist/js/bootstrap.bundle.min.js') }}"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/owl.carousel@2.3.4/dist/owl.carousel.min.js"></script>
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<script>
    $(document).on('mouseover','.location-item',function(){
        var location=JSON.parse($(this).attr('data-details'));
        // console.log(location);
        $('.location_name').text(location.name);
        $('.location_address').text(location.address);
        var times=JSON.parse($(this).attr('data-times'));
        // console.log(times);
        var timeHtml=``;
        for (var i=0;i<times.length;i++){
            timeHtml+=`<p class="mb-0"><span class="time-title">${times[i].title}</span>:
                               <span class="ms-2 from_to_time">${times[i].from} - ${times[i].to}</span>
                           </p>`;
        }
        $('.location_times').html(timeHtml);
        $('.time-details').show();
    })
    $(document).on('keyup','.location-input',function(e){
        var q=$('.location-input').val();
        updateLocations(q);
    })
    $(document).on('focus','.location-input',function(){
        var q=$('.location-input').val();
        $("#dropdown-return-locations").hide();
        updateLocations(q);
    });

    $(document).on('focus','.return_input_location',function(e){
        $('.return-drop-down').show();
        $("#dropdown-locations").hide();
        var q=$('.return_input_location').val();
        updateLocations(q,'return');

    });
    $(document).on('keyup','.return_input_location',function(e){
        $('.return-drop-down').show();
        var q=$('.return_input_location').val();
        updateLocations(q,'return');

    });





    function updateLocations(q='',type='location'){

        $.ajax({
            url:'{{route('search.locations')}}',
            type:"GET",
            data:{q:q},
            success:function(data){
                if(type=='location') {
                    $("#dropdown-locations").html(data.html);
                }
                if(type=='return') {
                    $("#dropdown-return-locations").html(data.html);
                }
            },
            error:function(error){

            }
        })
    }
    $(document).on('click','#dropdown-return-locations .location-item',function(e){
        e.preventDefault();
        var location=JSON.parse($(this).attr('data-details'));
        console.log('Resturn',location);
        $("#return_location_id").val(location.id);
        $("#dropdown-locations").hide();
        $("#dropdown-return-locations").hide();
        $(".return_input_location").val(location.name);
    });

    $(document).on('click','#dropdown-locations .location-item',function(e){
        e.preventDefault();
        var location=JSON.parse($(this).attr('data-details'));
        $("#location_id").val(location.id);
        $("#dropdown-locations").hide();
        $("#dropdown-return-locations").hide();
        $(".location-input").val(location.name);
    });


</script>
<script src="{{ asset('assets/js/java.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
<script>
    $(document).on('click','.btn-price-details',function(e){


        fetchPriceDetail();
    });
    $(document).ready(function(){
        fetchPriceDetail();
    });
    $(document).on('change','[name=protection_package_id]',function(){
        fetchPriceDetail();
    });


    function fetchPriceDetail(){
        var protection_package_id=$('[name=protection_package_id]:checked').val();
        var package_id=$('[name=package_id]:checked').val();
        var from=$('#single_car_details').attr('data-from');
        var to=$("#single_car_details").attr('data-to');
        var id=$("#single_car_details").attr('data-id');
        var location_id="{{request('location_id')}}";
        var extras=[];
        $('.extra-qty').each(function(){
            var id=$(this).attr('data-id');
            var qty=parseInt($(this).text());
            var price=$(this).attr('data-price');
            if(qty > 0) {
                extras.push({
                    id: id,
                    qty: qty,
                    price:price
                })
            }
        });

        $.ajax({
            url:"{{route('vehicle.price.update')}}",
            type:"GET",
            data:{
                location_id:location_id,
                from:from,
                to:to,
                id:id,
                extras:extras,
                package_id:package_id,
                protection_package_id:protection_package_id
            },
            success:function(data){
                console.log(data);
                $('#price_details').html(data.html);
                $('.total_price_update').html(data.total_price);
                $('#booking_overview_html').html(data.booking_overview);
            },
            error:function(error){
            }
        })
    }

    $(document).on('change','.toggle-extra-check',function(){
        if($(this).is(':checked')){
            console.log('Checked');
            $(this).closest('.option-card').find('.btn-toggle-extra').addClass('d-none').hide();
            $(this).closest('.option-card').find('.counter').show();
            $(this).closest('.option-card').find('.nav-count').text('1');

        }else {
            console.log('UnChecked');
            $(this).closest('.option-card').find('.btn-toggle-extra').removeClass('d-none').show();
            $(this).closest('.option-card').find('.counter').hide();
            $(this).closest('.option-card').find('.nav-count').text('0');

        }
        fetchPriceDetail();
    });
    $(document).on('click','.increment-nav',function(){
        var max_qty=parseInt($(this).attr('data-max-qty'));
        var currentQty=parseInt($(this).parent('.counter').find('.nav-count').text());
        console.log('Current',currentQty)
        if(currentQty >=max_qty){
            return;
        }
        var qty=currentQty+1;
        $(this).attr('data-qty',qty);
        $(this).closest('.counter').find('.nav-count').text(qty);
        fetchPriceDetail();


    });

    $(document).on('click','.decrement-nav',function(){
        var currentQty=parseInt($(this).parent('.counter').find('.nav-count').text());
        console.log('Current',currentQty)
        var qty=currentQty-1;
        if(qty < 1){

            $(this).closest('.option-card').find('.btn-toggle-extra').removeClass('d-none').show();
            $(this).closest('.option-card').find('.toggle-extra-check').prop('checked',false).change();
            // $(this).closest('.option-card').find('.toggle-extra-check').trigger('change');
            $(this).closest('.option-card').find('.counter').hide();
            $(this).attr('data-qty',0);
            return;
        }
        $(this).attr('data-qty',qty);
        $(this).closest('.counter').find('.nav-count').text(qty);

        fetchPriceDetail();

    });
</script>
@yield('scripts')
<script>

    function intializeDatePicker(){
        const today = moment(); // Current date
        const startDate = today.clone().add(7, 'days'); // Start date: 7 days from today
        const endDate = startDate.clone().add(6, 'days'); // End date: 1 week from start

        $('#start-date, #end-date').daterangepicker({
            autoApply: true, // Automatically apply the selected range
            timePicker: false,
            startDate: startDate,
            autoUpdateInput: true,
            endDate: endDate,
            locale: {
                format: 'DD.MM.YYYY', // Format for the displayed dates
            },
        });
        setTimeout(function(){
            $('#start-date').val(startDate.format('DD.MM.YYYY'));
            $('#end-date').val(endDate.format('DD.MM.YYYY'));
        },300)

        // Open daterangepicker when either input is focused
        $('#start-date, #end-date').on('apply.daterangepicker', function (ev, picker) {
            // Set the selected start and end dates into the inputs
            $('#start-date').val(picker.startDate.format('DD.MM.YYYY'));
            $('#end-date').val(picker.endDate.format('DD.MM.YYYY'));
        });
        $('#start-date, #end-date').on('cancel.daterangepicker', function () {
            $(this).val('');
        });

    }
    intializeDatePicker();


</script>
</body>
</html>
