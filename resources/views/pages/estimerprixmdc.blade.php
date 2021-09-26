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
               <h3 class="card-label">MDC List</h3>
            </div>
            <div class="card-toolbar">
               <!--begin::Button-->
               <a href="#"  id="estimer_prix" class="btn btn-primary font-weight-bolder">
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
                  </span>
                  Estimate the Price 
               </a>
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
<div class="modal fade" id="prixmdc" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
   <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Estimate the Price</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <i aria-hidden="true" class="ki ki-close"></i>
      </button>
   </div>
   <input type="hidden" name="" id="type_switch">
   <div class="modal-body">
      <form class="form" id="prixmdc_form">
         @csrf
         <input type="hidden" name="id">
         <div class="card-body">
            <div class="row">
               <div class="col-md-12 text-center">
                  <h4 class="text-center">Données Techniques</h4>
               </div>
            </div>
            <div class="form-group row">
               <div class="col-lg-6">
                  <label>Famille:</label>
                  
                  <select  name="famille" class="form-control" placeholder="Tapez la famille">
                     @foreach($famillies as $famille)
                         <option value="{{$famille->id}}">{{$famille->nom}}</option>
                     @endforeach
                      

                  </select>       
                  <span class="form-text text-muted">Choisissez la famille</span>
               </div>
               <div class="col-lg-6">
                  <label>Photo de la piece</label>
                  <input type="file"  accept="image/*"  name="path"  class="form-control" placeholder="Télécharger une photo"/>
                  <span class="form-text text-muted">Télécharger la photo</span>
               </div>
            </div>
            <div class="form-group row">
               <div class="col-lg-6">
                  <label>Client:</label>
                  <input type="text" name="client" class="form-control" placeholder="Taper le nom de client"/>
                  <span class="form-text text-muted">Taper le nom de client</span>
               </div>
               <div class="col-lg-6">
                  <label>Client Final:</label>
                  <input type="text" name="client_final" class="form-control" required placeholder="Taper le nom de client final"/>
                  <span class="form-text text-muted">Taper le nom de client final</span>
               </div>
            </div>
            <div class="form-group row">
               <div class="col-lg-6">
                  <label>Designation:</label>
                  <select  name="designation" class="form-control" placeholder="Choisissez la famille" required>
                     @foreach($designations as $designation)
                         <option value="{{$designation->id}}">{{$designation->nom}}</option>
                     @endforeach
                  </select>       
                  <span class="form-text text-muted">Choisisseez la designation</span>
               </div>
               <div class="col-lg-6">
                  <label>Projet:</label>
                  <input type="text" name="projet_nom" class="form-control" placeholder="Tapez le nom du projet"/>
                  <span class="form-text text-muted">Tapez le nom du projet</span>
               </div>
            </div>
            <div class="form-group row">
               <div class="col-lg-6">
                  <label>Nombre du MDC:</label>
                  <input type="radio" name="nbr_mdc" value="1"  /> LHD
                  <input type="radio" name="nbr_mdc" value="2" /> RHD
               </div>
               <div class="col-lg-6">
                  <label>Type du MDC:</label>
                  <input type="radio" name="type_mdc" value="1" /> Grand(G)
                  <input type="radio" name="type_mdc" value="2" /> Moyen(M)
               </div>
            </div>
            <div class="row">
               <div class="col-md-12 text-center">
                  <h4 class="text-center">Système Iso-statisme</h4>
               </div>
            </div>
            <div class="form-group row">
               <div class="col-lg-6">
                  <label>Reference point systems (RPS) :</label>
                  <input type="radio" name="system_iso_statisme_rps"  value="1"/> G
                  <input type="radio" name="system_iso_statisme_rps" value="2" /> M
                  <input type="text" name="rps_qte" class="form-control" placeholder="Quantité"/>
               </div>
               <div class="col-lg-6">
                  <label>Supports RPS :</label>
                  <input type="radio" name="system_iso_statisme_support_rps	"value="1"  /> G
                  <input type="radio" name="system_iso_statisme_support_rps	" value="2" /> M
                  <input type="text" name="system_iso_statisme_support_rps_qte" class="form-control" placeholder="Quantité"/>
               </div>
            </div>
            <div class="row">
               <div class="col-md-12 text-center">
                  <h4 class="text-center">Systèmes de fixation</h4>
               </div>
            </div>
            <div class="form-group row" >
               <div class="col-lg-6">
                  <input type="radio" name="choix" value="st" id='st' /> Systèmes Sauterelles
               </div>
               <div class="col-lg-6">
                  <input type="radio" name="choix" value="clip" id='clip' /> Systèmes Clippage 
               </div>
            </div>
            <div class="form-group row" id="">
               <div class="col-lg-6 sys_st ">
                  <label>Sauterelles :</label>
                  <input type="radio" name="system_fixation_str_type "  /> G
                  <input type="radio" name="system_fixation_str_type"  /> M
                  <input type="text" name="system_fixation_str_qte" class="form-control" placeholder="Quantité"/>
               </div>
               <div class="col-lg-6 sys_clip">
                  <label>Clip:</label>
                  <input type="text" name="system_fixation_clip_qte" class="form-control" placeholder="Quantité"/>
               </div>
            </div>
            <div class="form-group row" >
               <div class="col-lg-6 sys_st">
                  <label>Support Sauterelles :</label>
                  <input type="radio" name="system_fixation_support_str_type "  /> G
                  <input type="radio" name="system_fixation_support_str_type "  /> M
                  <input type="text" name="system_fixation_support_str_qte" class="form-control" placeholder="Quantité"/>
               </div>
               <div class="col-lg-6 sys_clip">
                  <label>Bridage_U:</label>
                  <input type="text" name="system_fixation_bridage_qte" class="form-control" placeholder="Quantité"/>
               </div>
            </div>
            <div class="row">
               <div class="col-md-12 text-center">
                  <h4 class="text-center">Système de Contrôle</h4>
               </div>
            </div>
            <div class="form-group row">
               <div class="col-lg-6">
                  <input type="radio" name="system" value='sm_com' id='sm_com' /> Systèmes Comparateur
               </div>
               <div class="col-lg-6">
                  <input type="radio" name="system" value='sm_ngo' id='sm_ngo' /> Systèmes Go-NGO
               </div>
            </div>
            <div class="form-group row">
               <div class="col-lg-6 sm_com">
                  <input type="radio" name="system_comparateur_smpl " value='sys_smp'   /> Simple
               </div>
               <div class="col-lg-6 sm_ngo">
                  <input type="radio" name="system_go_ngo_autre_sys " value='ngo_simple'  /> Simple
               </div>
            </div>
            <div class="form-group row">
               <div class="col-lg-6 sm_com sys_smp">
                  <label>Nombre des Points à Contrôle:</label>
                  <input type="text" name="system_comparateur_nbr_pc" class="form-control" placeholder="Quantité"/>
               </div>
               <div class="col-lg-6 sm_ngo ngo_autre">
                  <label>Nombre des Blocks de Mesure:</label>
                  <input type="text" name="system_go_ngo_nbr_bm" class="form-control" placeholder="Quantité"/>
               </div>
            </div>
            <div class="form-group row">
               <div class="col-lg-6 sm_com sys_smp">
                  <label>Support:</label>
                  <input type="text" name="system_comparateur_qte_support" class="form-control" placeholder="Quantité"/>
               </div>
               <div class="col-lg-6 sm_ngo">
                  <label>Support des Blocks de Mesure:</label>
                  <input type="text" name="system_go_ngo_support_bm" class="form-control" placeholder="Quantité"/>
               </div>
            </div>
            <div class="form-group row">
               <div class="col-lg-6 sm_com">
                  <input type="radio" name="system_comparateur_smpl " value='sys_autre'  /> Autres Systèmes
               </div>
               <div class="col-lg-6 sm_ngo">
                  <input type="radio" name="system_go_ngo_autre_sys"  value='ngo_autre'/> Autres Systèmes
               </div>
            </div>
            <div class="form-group row">
               <div class="col-lg-6 sm_com sys_autre">
                  <label>Nombre des Points à Contrôle:</label>
                  <input type="text" name="system_comparateur_nbr_pc" class="form-control" placeholder="Quantité"/>
               </div>
               <div class="col-lg-6 sm_ngo ngo_autre ">
                  <label>Nombre des Blocks de Mesure:</label>
                  <input type="text" name="system_go_ngo_nbr_bm" class="form-control" placeholder="Quantité"/>
               </div>
            </div>
            <div class="row">
               <div class="col-md-12 text-center">
                  <h4 class="text-center">Cout de conception du MDC</h4>
               </div>
            </div>
            <div class="form-group row">
               <div class="col-lg-2">
                  <input type="radio" name="cout_mdc_nom" value="3" /> MDC Wire
               </div>
               <div class="col-lg-2">
                  <input type="radio" name="cout_mdc_nom" value="4" /> Simple
               </div>
               <div class="col-lg-2">
                  <input type="radio" name="cout_mdc_nom" value="5" /> Moyen
               </div>
               <div class="col-lg-2">
                  <input type="radio" name="cout_mdc_nom"  value="6"/> Difficile
               </div>
               <div class="col-lg-2">
                     <input type="radio" name="cout_mdc_nom"  value="7"/> Proposer un cout
                </div>
                
            </div>
            <div class="form-group row">
               <div class="col-lg-6">
            <input type="text" name="cout_mdc_price" class="form-control" placeholder="Tapez le cout"/>
               </div>
            </div>
           
<!--
               <div class="row">
                  <div class="col-md-12 text-center">
                     <h4 class="text-center">Cout standard du MDC</h4>
                  </div>
               </div>

-->
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

    $('#estimer_prix').click(function(){
        $('#prixmdc_form')[0].reset()
        $('.modal-title').text('Add Prix MDC')
        $('#type_switch').val(0)
    
        $('#prixmdc').modal('show')
    })
    
    $('#desig_submit').click(function(){
        form=new FormData($('#prixmdc_form')[0])

        switcher=$('#type_switch').val()
        url1="{{ route('prixmdc.add') }}"
        url2="{{ route('prixmdc.update') }}"
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
                $('#prixmdc').modal('hide')
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
                url: "{{ route('prixmdc.show') }}",
                method: 'POST',
                data: function(d) {
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
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
                    field: "date",
                    
                    title: "{{ __('Date') }}",
                    filterable: !0,
                    width: 150,
                    class: "text-center",
                    sortable: !0,
                    render: function(a, b, c, d) {
                            return c.created_at
                    }
                },
                {
                    field: "famille",
                    data:"famille",
                    title: "{{ __('Famille') }}",
                    filterable: !0,
                    width: 150,
                    class: "text-center",
                    sortable: !0,
                    render: function(a, b, c, d) {
                            return c.famille
                    }
                },

                 {
                    field: "client",
                    data: "client",
                    title: '{{ __("Client") }}',
                    filterable: !0,
                    sortable: !0,
                    width: 50,
                    class: "font-weight-bold",
                    render: function(a, b, c, d) {
                        return c.client
                    }
                }, {
                    field: "designation",
                    data: "designation",
                    title: "{{ __('Designation') }}",
                    filterable: !0,
                    width: 90,
                    sortable: !0,
                    render: function(a, b, c, d) {
                        return c.nomdesigniation

                    }
                }, {
                    field: "projet",
                    data: "projet",
                    title: "{{ __('Projet') }}",
                    filterable: !0,
                    width: 90,
                    sortable: !0,
                    render: function(a, b, c, d) {
                        return c.nomprojet

                    }
                },
                {
                    field: "nbr_mdc",
                    data: "nbr_mdc",
                    title: "{{ __('Nombre MDC') }}",
                    filterable: !0,
                    width: 90,
                    sortable: !0,
                    render: function(a, b, c, d) {
                        return c.nbr_mdc

                    }
                },
                {
                    field: "type_mdc",
                    data: "type_mdc",
                    title: "{{ __('Type_MDC') }}",
                    filterable: !0,
                    width: 90,
                    sortable: !0,
                    render: function(a, b, c, d) {
                        return c.type_mdc

                    }
                },
                {
                    field: "prixtotal",
                    data: "prixtotal",
                    title: "{{ __('Prix') }}",
                    filterable: !0,
                    width: 90,
                    sortable: !0,
                    render: function(a, b, c, d) {
                        return parseInt(c.prixtotal)+parseInt(c.prixtotal1)+parseInt(c.prixtotal2)+parseInt(c.prixtotal3)+parseInt(c.prixtotal4)+parseInt(c.prixtotal5)

                    }
                },
                
                {
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
        url: "{{ route('prixmdc.delete') }}",
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
        url: "{{ route('prixmdc.get') }}",
        data: {id:id},
        dataType: "json",
        success: function (response) {
            $('#type_switch').val(1)
            $('input[name=famille]').val(response.nomfamille);
            $('input[name=client]').val(response.client);
            $('input[name=designation]').val(response.nomdesignation);
            $('input[name=projet_nom]').val(response.nomprojet);
            $('input[name=nbr_mdc]').val(response.nbr_mdc);
            $('input[name=type_mdc]').val(response.type_mdc);
            $('input[name=peixtotal]').val(response.prixtoatal);
    
            $('input[name=id]').val(response.id);

            $('.modal-title').text('Edit Informations')
            $('#prixmdc').modal('show')

        }
    });
}


$('input[name=choix]').change(function(){
        if (this.value=='st') {
            $('.sys_st').show()
            $('.sys_clip').hide()
        } else {
            $('.sys_st').hide()
            $('.sys_clip').show()
        }
})

$('input[name=system]').change(function(){
        if (this.value=='sm_com') {
            $('.sm_com').show()
            $('.sm_ngo').hide()
        } else {
            $('.sm_com').hide()
            $('.sm_ngo').show()
        }

})
$('input[name=system_comparateur_smpl]').change(function(){
   
        if (this.value=='sys_smp') {
            $('.sys_smp').show()
            $('.sys_autre').hide()
        } else {
            $('.sys_smp').hide()
            $('.sys_autre').show()
        }

})
$('input[name=system_go_ngo_autre_sys]').change(function(){
        if (this.value=='ngo_simple') {
            $('.ngo_simple').show()
            $('.ngo_autre').hide()
        } else {
            $('.ngo_simple').hide()
            $('.ngo_autre').show()
        }

})


</script>
@endsection