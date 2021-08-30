{{-- Extends layout --}}
@extends('layout.default')

{{-- Content --}}
@section('content')
<link href="{{asset('plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />

<div class="d-flex flex-column-fluid">
							<!--begin::Container-->
							<div class="container">

								<!--begin::Card-->
								<div class="card card-custom">
									<div class="card-header">
										<div class="card-title">
											<span class="card-icon">
												<i class="flaticon2-supermarket text-primary"></i>
											</span>
											<h3 class="card-label">Users List</h3>
										</div>
										<div class="card-toolbar">

											<!--begin::Button-->
											<a href="#"  id="add_account" class="btn btn-primary font-weight-bolder">
											<span class="svg-icon svg-icon-md">
												<!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
												<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
													<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
														<rect x="0" y="0" width="24" height="24" />
														<circle fill="#000000" cx="9" cy="15" r="6" />
														<path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3" />
													</g>
												</svg>
												<!--end::Svg Icon-->
											</span>Create Account</a>
											<!--end::Button-->
										</div>
									</div>
									<div class="card-body">
										<!--begin: Datatable-->
										<table class="table table-bordered table-hover table-checkable" id="m_table_1" style="margin-top: 13px !important">

										</table>
										<!--end: Datatable-->
									</div>
								</div>
								<!--end::Card-->
							</div>
							<!--end::Container-->
						</div>


                        <div class="modal fade" id="account" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Create Account</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <i aria-hidden="true" class="ki ki-close"></i>
                                        </button>
                                    </div>
                                    <input type="hidden" name="" id="type_switch">
                                    <div class="modal-body">
                                        <form class="form" id="account_form">
                                            @csrf
                                            <input type="hidden" name="id">
                                            <div class="card-body">
                                             <div class="form-group row">
                                              <div class="col-lg-6">
                                               <label>Name:</label>
                                               <input type="text" name="name" class="form-control" placeholder="Enter  name"/>
                                               <span class="form-text text-muted">Please enter the name</span>
                                              </div>
                                              <div class="col-lg-6">
                                               <label>Fonction:</label>
                                               <input type="text" name="fonction" class="form-control" placeholder="Enter  fonction"/>
                                               <span class="form-text text-muted">Please enter the fonction</span>
                                              </div>
                                              <div class="col-lg-6">
                                               <label>E-mail:</label>
                                               <input type="email" name="email" class="form-control" placeholder="Enter  e-mail"/>
                                               <span class="form-text text-muted">Please enter the mail</span>
                                              </div>
                                              <div class="col-lg-6">
                                               <label>Password:</label>
                                               <input type="password" name="password" class="form-control" placeholder="Enter  password"/>
                                               <span class="form-text text-muted">Please enter the password</span>
                                              </div>
                                              
                                             </div>
                                            
                                           </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                                        <button type="button" id="desig_submit" class="btn btn-primary font-weight-bold">Save Informations</button>
                                    </div>
                                </div>
                            </div>
                        </div>

 @endsection

{{-- Scripts Section --}}
@section('scripts')
<script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}"></script>

<script>

    $('#add_account').click(function(){
        $('#account_form')[0].reset()
        $('.modal-title').text('Add Account')
        $('#type_switch').val(0)
    
        $('#account').modal('show')
    })
    
    $('#desig_submit').click(function(){
        form=new FormData($('#account_form')[0])

        switcher=$('#type_switch').val()
        url1="{{ route('account.add') }}"
        url2="{{ route('account.update') }}"
        if (parseInt(switcher)===1) {
            url=url2
        } else {
            url=url1
        }
        $.ajax({
            type: "post",
            url: url,
            data: form,
            dataType: "json",
            processData: false,
            contentType: false,
            success: function (response) {
                t.draw()
                $('#account').modal('hide')
                toastr.success(response.message)
            }
        });
    })



    var t;
var table2
var DatatablesDataSourceAjaxServer = {
    init: function() {
        var myData = {};
        t = $("#m_table_1").DataTable({
            dom: 'frtlip',
            searchDelay: 500,
            processing: true,
            serverSide: true,
            order: [
                [1, 'desc']
            ],
            lengthMenu: [
                [20, 100, 500, -1],
                [20, 100, 500, "ALL"]
            ],
            select: {
                style: "multi",
                selector: "td:first-child .m-checkable"
            },
            headerCallback: function(e, a, t, n, s) {
                e.getElementsByTagName("th")[0].innerHTML =
                    '<label class="m-checkbox m-checkbox--single m-checkbox--solid m-checkbox--brand"><input type="checkbox" value="" class="m-group-checkable"><span></span></label>'
            },
            ajax: {
                url: "{{ route('account.show') }}",
                method: 'POST',
                data: function(d) {
                    d.startdate = myData.startdate;
                    d.enddate = myData.enddate;
                    d.bk=$('#bank_filter').val()
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            },
            footerCallback: function ( row, data, start, end, display ) {
            var api = this.api(), data;
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };

            // Total over all pages
            total = api
                .column( 4 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            // Total over this page
            pageTotal = api
                .column( 4, { page: 'current'} )
                .data()
                .reduce( function (a, b) {

                    return intVal(a) + intVal(b);
                }, 0 );

            // Update footer
            $( api.column( 4 ).footer() ).html(
                 formatMoney(total)
            );
        },
            columns: [{
                    targets: 0,

                    orderable: !1,
                    render: function(a, b, c, d) {
                        return ''
                    }
                },{
                    field: "id",
                    title: "{{ __('#Id') }}",
                    filterable: !0,
                    width:30 ,
                    class: "text-right font-weight-bold",
                    sortable: !0,
                    render: function(a, b, c, d) {
                        return '<button type="button" class="btn btn-outline-info btn-sm" onclick="getBankInfo('+c.id+')">#' +  c.id  + '</button>'
                    }
                }, 
                {
                    field: "name",
                    data:"name",
                    title: "{{ __('Name') }}",
                    filterable: !0,
                    width: 150,
                    class: "text-center",
                    sortable: !0,
                    render: function(a, b, c, d) {
                            return c.name
                    }
                },

                 {
                    field: "fonction",
                    data: "fonction",
                    title: '{{ __("Fonction") }}',
                    filterable: !0,
                    sortable: !0,
                    width: 50,
                    class: "font-weight-bold",
                    render: function(a, b, c, d) {
                        return c.fonction
                    }
                }, {
                    field: "email",
                    data: "email",
                    title: "{{ __('E-mail') }}",
                    filterable: !0,
                    width: 90,
                    sortable: !0,
                    render: function(a, b, c, d) {
                        return c.email

                    }
                },   {
                    field: "edit",
                    title: "",
                    width: 40,
                    textAlign: 'center',
                    sortable: false,
                    filterable: false,
                    searchable: false,
                    render: function(a, b, c, d) {
                          return '<a href="javascript:edit('+c.id+');" class="btn btn-sm btn-clean btn-icon" title="Edit details"><i class="la la-edit"></i></a><a href="javascript:remove('+c.id+');" class="btn btn-sm btn-clean btn-icon" title="Delete"><i class="la la-trash"></i>	</a>'
                    }
                }
            ],

        })



        t.on("change", ".m-group-checkable", function() {
            var a = $(this).closest("table").find("td:first-child .m-checkable"),
                z = $(this).is(":checked");
            $(a).each(function() {
                z ? ($(this).prop("checked", !0), t.rows($(this).closest("tr")).select()) :
                    ($(this).prop("checked", !1), t.rows($(this).closest("tr")).deselect())
            })
        })

        t.on("change", ".m-checkbox--single", function(e) {
            var a = $('td:first-child .m-checkable:checked').length;
            $("#m_datatable_selected_number").html(a), a > 0 ? $(".colap-item")
                .collapse("show") : $(".colap-item").collapse("hide")
        })




    }};


    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
jQuery(document).ready(function() {
    DatatablesDataSourceAjaxServer.init()


});


</script>

<script>

function remove(id){
    $.ajax({
        type: "post",
        url: "{{ route('account.delete') }}",
        data: {id:id},
        dataType: "json",
        success: function (response) {
            t.draw()
        }
    });
}

function edit(id){
    $.ajax({
        type: "post",
        url: "{{ route('account.get') }}",
        data: {id:id},
        dataType: "json",
        success: function (response) {
            $('#type_switch').val(1)
            $('input[name=name]').val(response.name);
            $('input[name=fonction]').val(response.fonction);
            $('input[name=email]').val(response.email);
            $('input[name=id]').val(response.id);

            $('.modal-title').text('Edit Account')
            $('#account').modal('show')

        }
    });
}
</script>
@endsection
