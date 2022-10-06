<?php

namespace App\Controllers;
use App\Models\MaterialModel;
use App\Models\MaterialDetailModel;
use App\Models\CustomerModel;
use App\Models\WarehouseModel;
use App\Models\OwnersModel;
use App\Models\BillModel;
use App\Models\OutboundModel;
use App\Models\OutboundpoModel;
use App\Models\OutboundpoDetailModel;
use App\Models\OutbounddoDetailModel;
use App\Models\OutbounddoModel;
use App\Models\PackagingMaterialModel;
use App\Models\OutboundPackageModel;
use App\Models\StateModel;
use Config\Services;
use PHPExcel;
use PHPExcel_IOFactory;

class Outboundpo extends BaseController
{
    public function __construct()
    {
        $this->material = new MaterialModel();
        $this->material_detail = new MaterialDetailModel();
        $this->customer = new CustomerModel();
        $this->warehouse = new WarehouseModel();
        $this->real_outbound = new OutboundModel();
        $this->outbound = new OutboundpoModel();
        $this->outbounddo = new OutbounddoModel();
        $this->owner = new OwnersModel();
        $this->bill = new BillModel();
        $this->pm = new PackagingMaterialModel();
        $this->packaging = new OutboundPackageModel();
        $this->state = new StateModel();
        $this->outbound_detail = new OutboundpoDetailModel();
        $this->outbounddo_detail = new OutbounddoDetailModel();

        helper(['form', 'url', 'my']);

        $GLOBALS['hris'] = 'https://hris.poslogistics.co.id/';
		// $GLOBALS['hris'] = 'http://app.poslogistics.co.id:6080/hris/';
    }

    public function index(){
        $data = [
            'title' => 'Outbound PO',
            'title_menu' => 'Outbound',
            'sidebar' => 'Outbound Plan'
        ];	

		echo view('layout/header', $data);
		echo view('outbound/outbound_po_data', $data);
		echo view('layout/footer');
    }

    public function getData(){
        if(session()->get('user_type')==1){
            $columns = array( 
                0 => 'po_outbound.po_outbound_id',
                1 => 'po_outbound.po_outbound_id',
                2 => 'po_outbound.po_outbound_id',
                3 => 'po_outbound.po_outbound_id',
                4 => 'po_outbound.po_create_date',
                5 => 'customer.customer_name',
                6 => 'warehouse.wh_name',
                7 => 'po_outbound.po_outbound_id'
            );
        } else {
            $columns = array( 
                0 => 'po_outbound.po_outbound_id',
                1 => 'po_outbound.po_outbound_id',
                2 => 'po_outbound.po_outbound_id',
                3 => 'po_outbound.po_outbound_id',
                4 => 'po_outbound.po_create_date',
                5 => 'customer.customer_name',
                6 => 'owners.owners_name',
                7 => 'warehouse.wh_name',
                8 => 'po_outbound.po_outbound_id'
            );

        }
        $limit = $this->request->getPost('length');
        $start = $this->request->getPost('start');
        $order = $columns[$this->request->getPost('order')[0]['column']];
        $dir = $this->request->getPost('order')[0]['dir']; 

        $totalData = $this->outbound->all_outbound_count();
        $totalFiltered = $totalData;

        if(empty($this->request->getPost('search')['value'])) { 
            $outbound = $this->outbound->all_outbound($limit, $start, $order, $dir);
        } else {
            $search = $this->request->getPost('search')['value']; 
            $outbound = $this->outbound->search_outbound($limit, $start, $search, $order, $dir);
            $totalFiltered = $this->outbound->search_outbound_count($search);
        }

        $data = array();
        if(@$outbound) {
            foreach ($outbound as $row) {
                $start++;
                if(session()->get('user_type')==1){
                    if(@$row->po_out_status == 1) {
                        $outbound_status = '<span class="label label-light-danger label-pill label-inline mr-2">New</span>';
                        $outbound_action = '<a href="'. base_url('outboundpo/detail/'.$row->po_outbound_id).'" class="btn btn-sm btn-clean btn-icon mr-1" title="Detail"><span class="svg-icon svg-icon-success svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <path d="M3,12 C3,12 5.45454545,6 12,6 C16.9090909,6 21,12 21,12 C21,12 16.9090909,18 12,18 C5.45454545,18 3,12 3,12 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                            <path d="M12,15 C10.3431458,15 9,13.6568542 9,12 C9,10.3431458 10.3431458,9 12,9 C13.6568542,9 15,10.3431458 15,12 C15,13.6568542 13.6568542,15 12,15 Z" fill="#000000" opacity="0.3"/>
                        </g>
                        </svg></span></a>
                        <button class="btn btn-sm btn-clean btn-icon mr-1" id="delete_outboundpo" data-id="'.@$row->po_outbound_id.'" title="Delete"><span class="svg-icon svg-icon-danger svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
                            <path d="M12.0355339,10.6213203 L14.863961,7.79289322 C15.2544853,7.40236893 15.8876503,7.40236893 16.2781746,7.79289322 C16.6686989,8.18341751 16.6686989,8.81658249 16.2781746,9.20710678 L13.4497475,12.0355339 L16.2781746,14.863961 C16.6686989,15.2544853 16.6686989,15.8876503 16.2781746,16.2781746 C15.8876503,16.6686989 15.2544853,16.6686989 14.863961,16.2781746 L12.0355339,13.4497475 L9.20710678,16.2781746 C8.81658249,16.6686989 8.18341751,16.6686989 7.79289322,16.2781746 C7.40236893,15.8876503 7.40236893,15.2544853 7.79289322,14.863961 L10.6213203,12.0355339 L7.79289322,9.20710678 C7.40236893,8.81658249 7.40236893,8.18341751 7.79289322,7.79289322 C8.18341751,7.40236893 8.81658249,7.40236893 9.20710678,7.79289322 L12.0355339,10.6213203 Z" fill="#000000"/>
                        </g>
                        </svg></span></button>';
                    } else if(@$row->po_out_status == 2)  { 
                        $outbound_status = '<span class="label label-light-success label-pill label-inline mr-2">Done</span>';
                        $outbound_action = '<a href="'. base_url('outboundpo/detail/'.$row->po_outbound_id).'" class="btn btn-sm btn-clean btn-icon mr-1" title="Detail"><span class="svg-icon svg-icon-success svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <path d="M3,12 C3,12 5.45454545,6 12,6 C16.9090909,6 21,12 21,12 C21,12 16.9090909,18 12,18 C5.45454545,18 3,12 3,12 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                            <path d="M12,15 C10.3431458,15 9,13.6568542 9,12 C9,10.3431458 10.3431458,9 12,9 C13.6568542,9 15,10.3431458 15,12 C15,13.6568542 13.6568542,15 12,15 Z" fill="#000000" opacity="0.3"/>
                        </g>
                        </svg></span></a>';
                    } else if(@$row->po_out_status == 3)  { 
                        $outbound_status = '<span class="label label-light-primary label-pill label-inline mr-2">Waiting for shipment</span>';
                        $outbound_action = '<a href="'. base_url('outboundpo/detail/'.$row->po_outbound_id).'" class="btn btn-sm btn-clean btn-icon mr-1" title="Detail"><span class="svg-icon svg-icon-success svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <path d="M3,12 C3,12 5.45454545,6 12,6 C16.9090909,6 21,12 21,12 C21,12 16.9090909,18 12,18 C5.45454545,18 3,12 3,12 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                            <path d="M12,15 C10.3431458,15 9,13.6568542 9,12 C9,10.3431458 10.3431458,9 12,9 C13.6568542,9 15,10.3431458 15,12 C15,13.6568542 13.6568542,15 12,15 Z" fill="#000000" opacity="0.3"/>
                        </g>
                        </svg></span></a>';
                    } else if(@$row->po_out_status == 4)  { 
                        $outbound_status = '<span class="label label-light-info label-pill label-inline mr-2">Shipping</span>';
                        // $outbound_action = '<a href="'. base_url('outboundpo/detail/'.$row->po_outbound_id).'" class="btn btn-sm btn-clean btn-icon mr-1" title="Detail"><span class="svg-icon svg-icon-success svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        // <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        //     <rect x="0" y="0" width="24" height="24"/>
                        //     <path d="M3,12 C3,12 5.45454545,6 12,6 C16.9090909,6 21,12 21,12 C21,12 16.9090909,18 12,18 C5.45454545,18 3,12 3,12 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                        //     <path d="M12,15 C10.3431458,15 9,13.6568542 9,12 C9,10.3431458 10.3431458,9 12,9 C13.6568542,9 15,10.3431458 15,12 C15,13.6568542 13.6568542,15 12,15 Z" fill="#000000" opacity="0.3"/>
                        // </g>
                        // </svg></span></a>
                        // <a href="'. base_url('outboundpo/invoice/'.$row->po_outbound_id).'" class="btn btn-sm btn-clean btn-icon mr-1" title="See Invoice"><span class="svg-icon svg-icon-success svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        // <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        //     <rect x="0" y="0" width="24" height="24"/>
                        //     <circle fill="#000000" opacity="0.3" cx="20.5" cy="12.5" r="1.5"/>
                        //     <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 6.500000) rotate(-15.000000) translate(-12.000000, -6.500000) " x="3" y="3" width="18" height="7" rx="1"/>
                        //     <path d="M22,9.33681558 C21.5453723,9.12084552 21.0367986,9 20.5,9 C18.5670034,9 17,10.5670034 17,12.5 C17,14.4329966 18.5670034,16 20.5,16 C21.0367986,16 21.5453723,15.8791545 22,15.6631844 L22,18 C22,19.1045695 21.1045695,20 20,20 L4,20 C2.8954305,20 2,19.1045695 2,18 L2,6 C2,4.8954305 2.8954305,4 4,4 L20,4 C21.1045695,4 22,4.8954305 22,6 L22,9.33681558 Z" fill="#000000"/>
                        // </g>
                        // </svg></span></a>

                        // <a href="'. base_url('outboundpo/tracking/'.$row->po_outbound_id).'" class="btn btn-sm btn-clean btn-icon mr-1" title="Tracking"><span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Communication\Sending.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M8,13.1668961 L20.4470385,11.9999863 L8,10.8330764 L8,5.77181995 C8,5.70108058 8.01501031,5.63114635 8.04403925,5.56663761 C8.15735832,5.31481744 8.45336217,5.20254012 8.70518234,5.31585919 L22.545552,11.5440255 C22.6569791,11.5941677 22.7461882,11.6833768 22.7963304,11.794804 C22.9096495,12.0466241 22.7973722,12.342628 22.545552,12.455947 L8.70518234,18.6841134 C8.64067359,18.7131423 8.57073936,18.7281526 8.5,18.7281526 C8.22385763,18.7281526 8,18.504295 8,18.2281526 L8,13.1668961 Z" fill="#000000"/><path d="M4,16 L5,16 C5.55228475,16 6,16.4477153 6,17 C6,17.5522847 5.55228475,18 5,18 L4,18 C3.44771525,18 3,17.5522847 3,17 C3,16.4477153 3.44771525,16 4,16 Z M1,11 L5,11 C5.55228475,11 6,11.4477153 6,12 C6,12.5522847 5.55228475,13 5,13 L1,13 C0.44771525,13 6.76353751e-17,12.5522847 0,12 C-6.76353751e-17,11.4477153 0.44771525,11 1,11 Z M4,6 L5,6 C5.55228475,6 6,6.44771525 6,7 C6,7.55228475 5.55228475,8 5,8 L4,8 C3.44771525,8 3,7.55228475 3,7 C3,6.44771525 3.44771525,6 4,6 Z" fill="#000000" opacity="0.3"/></g></svg><!--end::Svg Icon--></span></a>';
                        $outbound_action = '<a href="'. base_url('outboundpo/detail/'.$row->po_outbound_id).'" class="btn btn-sm btn-clean btn-icon mr-1" title="Detail"><span class="svg-icon svg-icon-success svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <path d="M3,12 C3,12 5.45454545,6 12,6 C16.9090909,6 21,12 21,12 C21,12 16.9090909,18 12,18 C5.45454545,18 3,12 3,12 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                            <path d="M12,15 C10.3431458,15 9,13.6568542 9,12 C9,10.3431458 10.3431458,9 12,9 C13.6568542,9 15,10.3431458 15,12 C15,13.6568542 13.6568542,15 12,15 Z" fill="#000000" opacity="0.3"/>
                        </g>
                        </svg></span></a>
                        <a href="'. base_url('outboundpo/invoice/'.$row->po_outbound_id).'" class="btn btn-sm btn-clean btn-icon mr-1" title="See Invoice"><span class="svg-icon svg-icon-success svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <circle fill="#000000" opacity="0.3" cx="20.5" cy="12.5" r="1.5"/>
                            <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 6.500000) rotate(-15.000000) translate(-12.000000, -6.500000) " x="3" y="3" width="18" height="7" rx="1"/>
                            <path d="M22,9.33681558 C21.5453723,9.12084552 21.0367986,9 20.5,9 C18.5670034,9 17,10.5670034 17,12.5 C17,14.4329966 18.5670034,16 20.5,16 C21.0367986,16 21.5453723,15.8791545 22,15.6631844 L22,18 C22,19.1045695 21.1045695,20 20,20 L4,20 C2.8954305,20 2,19.1045695 2,18 L2,6 C2,4.8954305 2.8954305,4 4,4 L20,4 C21.1045695,4 22,4.8954305 22,6 L22,9.33681558 Z" fill="#000000"/>
                        </g>
                        </svg></span></a>
                        <button class="btn btn-sm btn-clean btn-icon mr-1" id="finish_po" data-id="'.@$row->po_outbound_id.'" title="Finish Request"><span class="svg-icon svg-icon-info svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <polygon points="0 0 24 0 24 24 0 24"/>
                                <path d="M5.85714286,2 L13.7364114,2 C14.0910962,2 14.4343066,2.12568431 14.7051108,2.35473959 L19.4686994,6.3839416 C19.8056532,6.66894833 20,7.08787823 20,7.52920201 L20,20.0833333 C20,21.8738751 19.9795521,22 18.1428571,22 L5.85714286,22 C4.02044787,22 4,21.8738751 4,20.0833333 L4,3.91666667 C4,2.12612489 4.02044787,2 5.85714286,2 Z M10.875,15.75 C11.1145833,15.75 11.3541667,15.6541667 11.5458333,15.4625 L15.3791667,11.6291667 C15.7625,11.2458333 15.7625,10.6708333 15.3791667,10.2875 C14.9958333,9.90416667 14.4208333,9.90416667 14.0375,10.2875 L10.875,13.45 L9.62916667,12.2041667 C9.29375,11.8208333 8.67083333,11.8208333 8.2875,12.2041667 C7.90416667,12.5875 7.90416667,13.1625 8.2875,13.5458333 L10.2041667,15.4625 C10.3958333,15.6541667 10.6354167,15.75 10.875,15.75 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                <path d="M10.875,15.75 C10.6354167,15.75 10.3958333,15.6541667 10.2041667,15.4625 L8.2875,13.5458333 C7.90416667,13.1625 7.90416667,12.5875 8.2875,12.2041667 C8.67083333,11.8208333 9.29375,11.8208333 9.62916667,12.2041667 L10.875,13.45 L14.0375,10.2875 C14.4208333,9.90416667 14.9958333,9.90416667 15.3791667,10.2875 C15.7625,10.6708333 15.7625,11.2458333 15.3791667,11.6291667 L11.5458333,15.4625 C11.3541667,15.6541667 11.1145833,15.75 10.875,15.75 Z" fill="#000000"/>
                            </g>
                        </svg></span></button>
                        <a href="'. base_url('outboundpo/tracking/'.$row->po_outbound_id).'" class="btn btn-sm btn-clean btn-icon mr-1" title="Tracking"><span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Communication\Sending.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M8,13.1668961 L20.4470385,11.9999863 L8,10.8330764 L8,5.77181995 C8,5.70108058 8.01501031,5.63114635 8.04403925,5.56663761 C8.15735832,5.31481744 8.45336217,5.20254012 8.70518234,5.31585919 L22.545552,11.5440255 C22.6569791,11.5941677 22.7461882,11.6833768 22.7963304,11.794804 C22.9096495,12.0466241 22.7973722,12.342628 22.545552,12.455947 L8.70518234,18.6841134 C8.64067359,18.7131423 8.57073936,18.7281526 8.5,18.7281526 C8.22385763,18.7281526 8,18.504295 8,18.2281526 L8,13.1668961 Z" fill="#000000"/><path d="M4,16 L5,16 C5.55228475,16 6,16.4477153 6,17 C6,17.5522847 5.55228475,18 5,18 L4,18 C3.44771525,18 3,17.5522847 3,17 C3,16.4477153 3.44771525,16 4,16 Z M1,11 L5,11 C5.55228475,11 6,11.4477153 6,12 C6,12.5522847 5.55228475,13 5,13 L1,13 C0.44771525,13 6.76353751e-17,12.5522847 0,12 C-6.76353751e-17,11.4477153 0.44771525,11 1,11 Z M4,6 L5,6 C5.55228475,6 6,6.44771525 6,7 C6,7.55228475 5.55228475,8 5,8 L4,8 C3.44771525,8 3,7.55228475 3,7 C3,6.44771525 3.44771525,6 4,6 Z" fill="#000000" opacity="0.3"/></g></svg><!--end::Svg Icon--></span></a>';
                    } else if(@$row->po_out_status == 5)  { 
                        $outbound_status = '<span class="label label-light-info label-pill label-inline mr-2">Approved</span>';
                        $outbound_action = '<a href="'. base_url('outboundpo/detail/'.$row->po_outbound_id).'" class="btn btn-sm btn-clean btn-icon mr-1" title="Detail"><span class="svg-icon svg-icon-success svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <path d="M3,12 C3,12 5.45454545,6 12,6 C16.9090909,6 21,12 21,12 C21,12 16.9090909,18 12,18 C5.45454545,18 3,12 3,12 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                            <path d="M12,15 C10.3431458,15 9,13.6568542 9,12 C9,10.3431458 10.3431458,9 12,9 C13.6568542,9 15,10.3431458 15,12 C15,13.6568542 13.6568542,15 12,15 Z" fill="#000000" opacity="0.3"/>
                        </g>
                        </svg></span></a>
                        <a href="'. base_url('outboundpo/invoice/'.$row->po_outbound_id).'" class="btn btn-sm btn-clean btn-icon mr-1" title="See Invoice"><span class="svg-icon svg-icon-success svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <circle fill="#000000" opacity="0.3" cx="20.5" cy="12.5" r="1.5"/>
                            <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 6.500000) rotate(-15.000000) translate(-12.000000, -6.500000) " x="3" y="3" width="18" height="7" rx="1"/>
                            <path d="M22,9.33681558 C21.5453723,9.12084552 21.0367986,9 20.5,9 C18.5670034,9 17,10.5670034 17,12.5 C17,14.4329966 18.5670034,16 20.5,16 C21.0367986,16 21.5453723,15.8791545 22,15.6631844 L22,18 C22,19.1045695 21.1045695,20 20,20 L4,20 C2.8954305,20 2,19.1045695 2,18 L2,6 C2,4.8954305 2.8954305,4 4,4 L20,4 C21.1045695,4 22,4.8954305 22,6 L22,9.33681558 Z" fill="#000000"/>
                        </g>
                        </svg></span></a>
                        <button class="btn btn-sm btn-clean btn-icon mr-1" id="finish_po" data-id="'.@$row->po_outbound_id.'" title="Finish Request"><span class="svg-icon svg-icon-info svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <polygon points="0 0 24 0 24 24 0 24"/>
                                <path d="M5.85714286,2 L13.7364114,2 C14.0910962,2 14.4343066,2.12568431 14.7051108,2.35473959 L19.4686994,6.3839416 C19.8056532,6.66894833 20,7.08787823 20,7.52920201 L20,20.0833333 C20,21.8738751 19.9795521,22 18.1428571,22 L5.85714286,22 C4.02044787,22 4,21.8738751 4,20.0833333 L4,3.91666667 C4,2.12612489 4.02044787,2 5.85714286,2 Z M10.875,15.75 C11.1145833,15.75 11.3541667,15.6541667 11.5458333,15.4625 L15.3791667,11.6291667 C15.7625,11.2458333 15.7625,10.6708333 15.3791667,10.2875 C14.9958333,9.90416667 14.4208333,9.90416667 14.0375,10.2875 L10.875,13.45 L9.62916667,12.2041667 C9.29375,11.8208333 8.67083333,11.8208333 8.2875,12.2041667 C7.90416667,12.5875 7.90416667,13.1625 8.2875,13.5458333 L10.2041667,15.4625 C10.3958333,15.6541667 10.6354167,15.75 10.875,15.75 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                <path d="M10.875,15.75 C10.6354167,15.75 10.3958333,15.6541667 10.2041667,15.4625 L8.2875,13.5458333 C7.90416667,13.1625 7.90416667,12.5875 8.2875,12.2041667 C8.67083333,11.8208333 9.29375,11.8208333 9.62916667,12.2041667 L10.875,13.45 L14.0375,10.2875 C14.4208333,9.90416667 14.9958333,9.90416667 15.3791667,10.2875 C15.7625,10.6708333 15.7625,11.2458333 15.3791667,11.6291667 L11.5458333,15.4625 C11.3541667,15.6541667 11.1145833,15.75 10.875,15.75 Z" fill="#000000"/>
                            </g>
                        </svg></span></button>
                        <a href="'. base_url('outboundpo/tracking/'.$row->po_outbound_id).'" class="btn btn-sm btn-clean btn-icon mr-1" title="Tracking"><span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Communication\Sending.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M8,13.1668961 L20.4470385,11.9999863 L8,10.8330764 L8,5.77181995 C8,5.70108058 8.01501031,5.63114635 8.04403925,5.56663761 C8.15735832,5.31481744 8.45336217,5.20254012 8.70518234,5.31585919 L22.545552,11.5440255 C22.6569791,11.5941677 22.7461882,11.6833768 22.7963304,11.794804 C22.9096495,12.0466241 22.7973722,12.342628 22.545552,12.455947 L8.70518234,18.6841134 C8.64067359,18.7131423 8.57073936,18.7281526 8.5,18.7281526 C8.22385763,18.7281526 8,18.504295 8,18.2281526 L8,13.1668961 Z" fill="#000000"/><path d="M4,16 L5,16 C5.55228475,16 6,16.4477153 6,17 C6,17.5522847 5.55228475,18 5,18 L4,18 C3.44771525,18 3,17.5522847 3,17 C3,16.4477153 3.44771525,16 4,16 Z M1,11 L5,11 C5.55228475,11 6,11.4477153 6,12 C6,12.5522847 5.55228475,13 5,13 L1,13 C0.44771525,13 6.76353751e-17,12.5522847 0,12 C-6.76353751e-17,11.4477153 0.44771525,11 1,11 Z M4,6 L5,6 C5.55228475,6 6,6.44771525 6,7 C6,7.55228475 5.55228475,8 5,8 L4,8 C3.44771525,8 3,7.55228475 3,7 C3,6.44771525 3.44771525,6 4,6 Z" fill="#000000" opacity="0.3"/></g></svg><!--end::Svg Icon--></span></a>';
                    } else if(@$row->po_out_status == 6)  { 
                        $outbound_status = '<span class="label label-light-danger label-pill label-inline mr-2">AWB Rejected</span>';
                        $outbound_action = '<a href="'. base_url('outboundpo/detail/'.$row->po_outbound_id).'" class="btn btn-sm btn-clean btn-icon mr-1" title="Detail"><span class="svg-icon svg-icon-success svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <path d="M3,12 C3,12 5.45454545,6 12,6 C16.9090909,6 21,12 21,12 C21,12 16.9090909,18 12,18 C5.45454545,18 3,12 3,12 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                            <path d="M12,15 C10.3431458,15 9,13.6568542 9,12 C9,10.3431458 10.3431458,9 12,9 C13.6568542,9 15,10.3431458 15,12 C15,13.6568542 13.6568542,15 12,15 Z" fill="#000000" opacity="0.3"/>
                        </g>
                        </svg></span></a>
                        <a href="'. base_url('outboundpo/invoice/'.$row->po_outbound_id).'" class="btn btn-sm btn-clean btn-icon mr-1" title="See Invoice"><span class="svg-icon svg-icon-success svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <circle fill="#000000" opacity="0.3" cx="20.5" cy="12.5" r="1.5"/>
                            <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 6.500000) rotate(-15.000000) translate(-12.000000, -6.500000) " x="3" y="3" width="18" height="7" rx="1"/>
                            <path d="M22,9.33681558 C21.5453723,9.12084552 21.0367986,9 20.5,9 C18.5670034,9 17,10.5670034 17,12.5 C17,14.4329966 18.5670034,16 20.5,16 C21.0367986,16 21.5453723,15.8791545 22,15.6631844 L22,18 C22,19.1045695 21.1045695,20 20,20 L4,20 C2.8954305,20 2,19.1045695 2,18 L2,6 C2,4.8954305 2.8954305,4 4,4 L20,4 C21.1045695,4 22,4.8954305 22,6 L22,9.33681558 Z" fill="#000000"/>
                        </g>
                        </svg></span></a>
                        <a href="'. base_url('outboundpo/tracking/'.$row->po_outbound_id).'" class="btn btn-sm btn-clean btn-icon mr-1" title="Tracking"><span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Communication\Sending.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M8,13.1668961 L20.4470385,11.9999863 L8,10.8330764 L8,5.77181995 C8,5.70108058 8.01501031,5.63114635 8.04403925,5.56663761 C8.15735832,5.31481744 8.45336217,5.20254012 8.70518234,5.31585919 L22.545552,11.5440255 C22.6569791,11.5941677 22.7461882,11.6833768 22.7963304,11.794804 C22.9096495,12.0466241 22.7973722,12.342628 22.545552,12.455947 L8.70518234,18.6841134 C8.64067359,18.7131423 8.57073936,18.7281526 8.5,18.7281526 C8.22385763,18.7281526 8,18.504295 8,18.2281526 L8,13.1668961 Z" fill="#000000"/><path d="M4,16 L5,16 C5.55228475,16 6,16.4477153 6,17 C6,17.5522847 5.55228475,18 5,18 L4,18 C3.44771525,18 3,17.5522847 3,17 C3,16.4477153 3.44771525,16 4,16 Z M1,11 L5,11 C5.55228475,11 6,11.4477153 6,12 C6,12.5522847 5.55228475,13 5,13 L1,13 C0.44771525,13 6.76353751e-17,12.5522847 0,12 C-6.76353751e-17,11.4477153 0.44771525,11 1,11 Z M4,6 L5,6 C5.55228475,6 6,6.44771525 6,7 C6,7.55228475 5.55228475,8 5,8 L4,8 C3.44771525,8 3,7.55228475 3,7 C3,6.44771525 3.44771525,6 4,6 Z" fill="#000000" opacity="0.3"/></g></svg><!--end::Svg Icon--></span></a>';
                    } else if(@$row->po_out_status == 7)  { 
                        $outbound_status = '<span class="label label-light-success label-pill label-inline mr-2">Done</span>';
                        $outbound_action = '<a href="'. base_url('outboundpo/detail/'.$row->po_outbound_id).'" class="btn btn-sm btn-clean btn-icon mr-1" title="Detail"><span class="svg-icon svg-icon-success svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <path d="M3,12 C3,12 5.45454545,6 12,6 C16.9090909,6 21,12 21,12 C21,12 16.9090909,18 12,18 C5.45454545,18 3,12 3,12 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                            <path d="M12,15 C10.3431458,15 9,13.6568542 9,12 C9,10.3431458 10.3431458,9 12,9 C13.6568542,9 15,10.3431458 15,12 C15,13.6568542 13.6568542,15 12,15 Z" fill="#000000" opacity="0.3"/>
                        </g>
                        </svg></span></a>
                        <a href="'. base_url('outboundpo/invoice/'.$row->po_outbound_id).'" class="btn btn-sm btn-clean btn-icon mr-1" title="See Invoice"><span class="svg-icon svg-icon-success svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <circle fill="#000000" opacity="0.3" cx="20.5" cy="12.5" r="1.5"/>
                            <rect fill="#000000" opacity="0.3" transform="translate(12.000000, 6.500000) rotate(-15.000000) translate(-12.000000, -6.500000) " x="3" y="3" width="18" height="7" rx="1"/>
                            <path d="M22,9.33681558 C21.5453723,9.12084552 21.0367986,9 20.5,9 C18.5670034,9 17,10.5670034 17,12.5 C17,14.4329966 18.5670034,16 20.5,16 C21.0367986,16 21.5453723,15.8791545 22,15.6631844 L22,18 C22,19.1045695 21.1045695,20 20,20 L4,20 C2.8954305,20 2,19.1045695 2,18 L2,6 C2,4.8954305 2.8954305,4 4,4 L20,4 C21.1045695,4 22,4.8954305 22,6 L22,9.33681558 Z" fill="#000000"/>
                        </g>
                        </svg></span></a>
                        <a href="'. base_url('outboundpo/tracking/'.$row->po_outbound_id).'" class="btn btn-sm btn-clean btn-icon mr-1" title="Tracking"><span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Communication\Sending.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><path d="M8,13.1668961 L20.4470385,11.9999863 L8,10.8330764 L8,5.77181995 C8,5.70108058 8.01501031,5.63114635 8.04403925,5.56663761 C8.15735832,5.31481744 8.45336217,5.20254012 8.70518234,5.31585919 L22.545552,11.5440255 C22.6569791,11.5941677 22.7461882,11.6833768 22.7963304,11.794804 C22.9096495,12.0466241 22.7973722,12.342628 22.545552,12.455947 L8.70518234,18.6841134 C8.64067359,18.7131423 8.57073936,18.7281526 8.5,18.7281526 C8.22385763,18.7281526 8,18.504295 8,18.2281526 L8,13.1668961 Z" fill="#000000"/><path d="M4,16 L5,16 C5.55228475,16 6,16.4477153 6,17 C6,17.5522847 5.55228475,18 5,18 L4,18 C3.44771525,18 3,17.5522847 3,17 C3,16.4477153 3.44771525,16 4,16 Z M1,11 L5,11 C5.55228475,11 6,11.4477153 6,12 C6,12.5522847 5.55228475,13 5,13 L1,13 C0.44771525,13 6.76353751e-17,12.5522847 0,12 C-6.76353751e-17,11.4477153 0.44771525,11 1,11 Z M4,6 L5,6 C5.55228475,6 6,6.44771525 6,7 C6,7.55228475 5.55228475,8 5,8 L4,8 C3.44771525,8 3,7.55228475 3,7 C3,6.44771525 3.44771525,6 4,6 Z" fill="#000000" opacity="0.3"/></g></svg><!--end::Svg Icon--></span></a>';
                    }
                } else {
                    if(@$row->po_out_status == 1) {
                        $outbound_status = '<span class="label label-light-success label-pill label-inline mr-2">New</span>';
                        $outbound_action = '<a href="'. base_url('outboundpo/detail/'.$row->po_outbound_id).'" class="btn btn-sm btn-clean btn-icon mr-1" title="Detail"><span class="svg-icon svg-icon-success svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <path d="M3,12 C3,12 5.45454545,6 12,6 C16.9090909,6 21,12 21,12 C21,12 16.9090909,18 12,18 C5.45454545,18 3,12 3,12 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                            <path d="M12,15 C10.3431458,15 9,13.6568542 9,12 C9,10.3431458 10.3431458,9 12,9 C13.6568542,9 15,10.3431458 15,12 C15,13.6568542 13.6568542,15 12,15 Z" fill="#000000" opacity="0.3"/>
                        </g>
                        </svg></span></a>';
                    } else if(@$row->po_out_status == 2)  { 
                        $outbound_status = '<span class="label label-light-danger label-pill label-inline mr-2">Packing</span>';
                        $outbound_action = '<a href="'. base_url('outboundpo/detail/'.$row->po_outbound_id).'" class="btn btn-sm btn-clean btn-icon mr-1" title="Detail"><span class="svg-icon svg-icon-success svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <path d="M3,12 C3,12 5.45454545,6 12,6 C16.9090909,6 21,12 21,12 C21,12 16.9090909,18 12,18 C5.45454545,18 3,12 3,12 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                            <path d="M12,15 C10.3431458,15 9,13.6568542 9,12 C9,10.3431458 10.3431458,9 12,9 C13.6568542,9 15,10.3431458 15,12 C15,13.6568542 13.6568542,15 12,15 Z" fill="#000000" opacity="0.3"/>
                        </g>
                        </svg></span></a>';
                    } else if(@$row->po_out_status == 3)  { 
                        $outbound_status = '<span class="label label-light-primary label-pill label-inline mr-2">Waiting for shipment</span>';
                        $outbound_action = '<a href="'. base_url('outboundpo/detail/'.$row->po_outbound_id).'" class="btn btn-sm btn-clean btn-icon mr-1" title="Detail"><span class="svg-icon svg-icon-success svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <path d="M3,12 C3,12 5.45454545,6 12,6 C16.9090909,6 21,12 21,12 C21,12 16.9090909,18 12,18 C5.45454545,18 3,12 3,12 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                            <path d="M12,15 C10.3431458,15 9,13.6568542 9,12 C9,10.3431458 10.3431458,9 12,9 C13.6568542,9 15,10.3431458 15,12 C15,13.6568542 13.6568542,15 12,15 Z" fill="#000000" opacity="0.3"/>
                        </g>
                        </svg></span></a>';
                    } else if(@$row->po_out_status == 4)  { 
                        $outbound_status = '<span class="label label-light-info label-pill label-inline mr-2">Shipping</span>';
                        $outbound_action = '<a href="'. base_url('outboundpo/detail/'.$row->po_outbound_id).'" class="btn btn-sm btn-clean btn-icon mr-1" title="Detail"><span class="svg-icon svg-icon-success svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <path d="M3,12 C3,12 5.45454545,6 12,6 C16.9090909,6 21,12 21,12 C21,12 16.9090909,18 12,18 C5.45454545,18 3,12 3,12 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                            <path d="M12,15 C10.3431458,15 9,13.6568542 9,12 C9,10.3431458 10.3431458,9 12,9 C13.6568542,9 15,10.3431458 15,12 C15,13.6568542 13.6568542,15 12,15 Z" fill="#000000" opacity="0.3"/>
                        </g>
                        </svg></span></a>';
                    } else if(@$row->po_out_status == 5)  { 
                        $outbound_status = '<span class="label label-light-info label-pill label-inline mr-2">Approved</span>';
                        $outbound_action = '<a href="'. base_url('outboundpo/detail/'.$row->po_outbound_id).'" class="btn btn-sm btn-clean btn-icon mr-1" title="Detail"><span class="svg-icon svg-icon-success svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <path d="M3,12 C3,12 5.45454545,6 12,6 C16.9090909,6 21,12 21,12 C21,12 16.9090909,18 12,18 C5.45454545,18 3,12 3,12 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                            <path d="M12,15 C10.3431458,15 9,13.6568542 9,12 C9,10.3431458 10.3431458,9 12,9 C13.6568542,9 15,10.3431458 15,12 C15,13.6568542 13.6568542,15 12,15 Z" fill="#000000" opacity="0.3"/>
                        </g>
                        </svg></span></a>';
                    } else if(@$row->po_out_status == 6)  { 
                        $outbound_status = '<span class="label label-light-danger label-pill label-inline mr-2">AWB Rejected</span>';
                        $outbound_action = '<a href="'. base_url('outboundpo/detail/'.$row->po_outbound_id).'" class="btn btn-sm btn-clean btn-icon mr-1" title="Detail"><span class="svg-icon svg-icon-success svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <path d="M3,12 C3,12 5.45454545,6 12,6 C16.9090909,6 21,12 21,12 C21,12 16.9090909,18 12,18 C5.45454545,18 3,12 3,12 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                            <path d="M12,15 C10.3431458,15 9,13.6568542 9,12 C9,10.3431458 10.3431458,9 12,9 C13.6568542,9 15,10.3431458 15,12 C15,13.6568542 13.6568542,15 12,15 Z" fill="#000000" opacity="0.3"/>
                        </g>
                        </svg></span></a>';
                    } else if(@$row->po_out_status == 7)  { 
                        $outbound_status = '<span class="label label-light-success label-pill label-inline mr-2">Done</span>';
                        $outbound_action = '<a href="'. base_url('outboundpo/detail/'.$row->po_outbound_id).'" class="btn btn-sm btn-clean btn-icon mr-1" title="Detail"><span class="svg-icon svg-icon-success svg-icon-md"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <path d="M3,12 C3,12 5.45454545,6 12,6 C16.9090909,6 21,12 21,12 C21,12 16.9090909,18 12,18 C5.45454545,18 3,12 3,12 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                            <path d="M12,15 C10.3431458,15 9,13.6568542 9,12 C9,10.3431458 10.3431458,9 12,9 C13.6568542,9 15,10.3431458 15,12 C15,13.6568542 13.6568542,15 12,15 Z" fill="#000000" opacity="0.3"/>
                        </g>
                        </svg></span></a>';
                    }
                }

                $material_detail = $this->outbound->get_outbound_detail($row->po_outbound_id);
                $arrayMaterial = [];

                foreach($material_detail as $mat){
                    $dataMat = '<li>' . $mat->material_name . ', '.$mat->outbound_qty.' ' . $mat->uom_name . '</li>';
                    array_push($arrayMaterial, $dataMat);
                }
                $outbound_mat = join("", $arrayMaterial);

                $arrayDetail = [];

                // foreach($material_detail as $det){
                //     $dataDet = '<li>' . $det->material_name . ', '.$det->qty_realization.' ' . $det->uom_name . '</li>';
                //     array_push($arrayDetail, $dataDet);
                // }
                // $outbound_det = join("", $arrayDetail);

                $nestedData['number'] = $start;
                $nestedData['po_outbound_id'] = @$row->po_outbound_id;
                // $nestedData['po_outbound_doc'] = @$row->po_outbound_doc;
                $nestedData['po_outbound_date'] = date('d-m-Y', strtotime(@$row->po_create_date));
                $nestedData['customer_name'] = @$row->customer_name;
                $nestedData['warehouse_name'] = @$row->wh_name;
                if(session()->get('user_type')!=1){
                    $nestedData['owners_name'] = @$row->owners_name;
                }
                $nestedData['material_name'] = $outbound_mat;
                $nestedData['status'] = $outbound_status;
                $nestedData['action'] = $outbound_action;
                
                $data[] = $nestedData;
            }
        }
          
        $json_data = array(
                    "draw"            => intval($this->request->getPost('draw')),  
                    "recordsTotal"    => intval($totalData),  
                    "recordsFiltered" => intval($totalFiltered), 
                    "data"            => $data
                );
            
        echo json_encode($json_data);
    }

    public function getColumns()
	{
        if(session()->get('user_type')==1){
		    $fields = array('po_outbound_id', 'po_outbound_date', 'customer_name', 'warehouse_name', 'material_name');
        } else {
		    $fields = array('po_outbound_id', 'po_outbound_date', 'owners_name', 'customer_name', 'warehouse_name', 'material_name');
        }
		$columns[] = array(
			'data' => 'number',
			'className' => 'text-center'
		);
        $columns[] = array(
            'data' => 'action',
            'className' => 'text-center text-nowrap'
        );
        $columns[] = array(
            'data' => 'status',
            'className' => 'text-center'
        );
		foreach ($fields as $field) {
			$columns[] = array(
				'data' => $field,
                'className' => 'text-nowrap'
			);
		}
		echo json_encode($columns); 
	}

    public function add()
	{
		$data = [
            'title' => 'Outbound',
            'title_menu' => 'Outbound',
            'sidebar' => 'Outbound'
        ];	

        if($this->request->getPost('po_id')){
            $outbound = $this->outbound->get_outbound($this->request->getPost('po_id'));
        }else{
            $purchase_order = '';
        }

		$dataObject = [
			'validation' => \Config\Services::validation(),
            'warehouse' => $this->warehouse->get_all_warehouse(),
            'customer' => $this->customer->get_all_customer(),
            'pm' => $this->pm->get_all_pm_not_kardus(),
            'transporter' => $this->outbounddo->get_transporter()
            // 'material' => $this->material_detail->get_all_material_byowner(session()->get('owners_id')),
            // 'owner' => $this->owner->get_all_owner()
		];

        $customer = $this->customer->get_all_customer();

        if($customer == null){
            session()->setFlashdata('message', '<div class="alert alert-custom alert-light-warning fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Customer data is empty. Click <a href="'.base_url('/customer').'">Here</a> to add new Customer</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');
        }

		echo view('layout/header', $data);
		echo view('outbound/add_outbound_po', $dataObject);
		echo view('layout/footer');
	}

    public function add_courier($po_outbound_id = NULL) {
		$data = [
            'title' => 'Outbound',
            'title_menu' => 'Outbound',
            'sidebar' => 'Outbound'
        ];	

		$dataObject = [
			'validation' => \Config\Services::validation(),
            'outbound' => $this->outbound->get_outbound_byid($po_outbound_id),
            'outbound_detail' => $this->outbound->get_outbound_detail($po_outbound_id),
            'transporter' => $this->outbounddo->get_transporter()
            // 'material' => $this->material_detail->get_all_material_byowner(session()->get('owners_id')),
            // 'owner' => $this->owner->get_all_owner()
		];

		echo view('layout/header', $data);
		echo view('outbound/add_outbound_po2', $dataObject);
		echo view('layout/footer');
	}

    public function bulk_upload(){
        $file = $this->request->getFile('fileexcel');
        
		if($file){
            $data_outbound = array();
            $data_outbound_detail = array();
			$excelReader  = new PHPExcel();
			//mengambil lokasi temp file
			$fileLocation = $file->getTempName(); // edit disini biar hilang
			//baca file
			$objPHPExcel = PHPExcel_IOFactory::load($fileLocation);
            // unlink($fileLocation);
			//ambil sheet active
			$sheet	= $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
			//looping untuk mengambil data
			foreach ($sheet as $idx => $data) {
                //skip index 1 karena title excel
                if($idx<=10){
                    continue;
                }
                
                if(!empty($data['A'])){
                    $warehouse = @$this->warehouse->get_warehouse_bycode($data['A'])->warehouse_id;
                    $customer_phone = $data['F'];
                    $zip_code = $data['I'];
                    $data_outbound[] = array(
                        'warehouse_code' => $data['A'], 
                        'warehouse_id' => $warehouse, 
                        'transporter_alias' => $data['B'],
                        'po_out_date' => date_format(date_create($data['C']), 'Y-m-d'),
                        'po_description' => $data['D'], 
                        'customer_name' => $data['E'],
                        'customer_phone' => $customer_phone,
                        'customer_email' => $data['G'],
                        'customer_address' => $data['H'],
                        'zip_code' => $zip_code,
                    );
                } else {
                    $data_outbound[] = array(
                        'warehouse_code' => 'PO_DETAIL', 
                        'warehouse_id' => 'PO_DETAIL', 
                        'transporter_alias' => 'PO_DETAIL',
                        'po_out_date' => 'PO_DETAIL',
                        'po_description' => 'PO_DETAIL', 
                        'customer_name' => 'PO_DETAIL',
                        'customer_phone' => 'PO_DETAIL',
                        'customer_email' => 'PO_DETAIL',
                        'customer_address' => 'PO_DETAIL',
                        'zip_code' => 'PO_DETAIL',
                    );
                }
                $material_price = $this->material_detail->get_material_price($data['J'], session()->get('owners_id'))->material_price;
    
                $qty = str_replace(",", "", $data['K']);
                $data_outbound_detail[] = array(
                    'material_id' => $data['J'],
                    'material_price' => $material_price,
                    'outbound_qty' => $qty,
                    'qty_good' => $qty,
                    'status' => 1
                );
            }
            $data = [
                'title' => 'Transaction',
                'title_menu' => 'Bulk Add Transaction',
                'sidebar' => 'Transaction'
            ];
            $dataObject = [
                'validation' => \Config\Services::validation(),
                'data_outbound' => $data_outbound,
                'data_outbound_detail' => $data_outbound_detail,
                'import' => 1
            ];
            clearstatcache();
            echo view('layout/header', $data);
            echo view('outbound/bulk_upload', $dataObject);
            echo view('layout/footer');
		} else {
            $data = [
                'title' => 'Transaction',
                'title_menu' => 'Bulk Add Transaction',
                'sidebar' => 'Transaction'
            ];	

            $dataObject = [
                'validation' => \Config\Services::validation(),
                'import' => 0
            ];
            echo view('layout/header', $data);
            echo view('outbound/bulk_upload', $dataObject);
            echo view('layout/footer');
        }
    }

    public function bulk_create(){
        $validation = $this->validate([
            'outbound.*.warehouse_id'       => ['label' => 'Warehouse Code', 'rules' => 'required'],
            'outbound.*.transporter_alias'  => ['label' => 'Logistik', 'rules' => 'required'],
            'outbound.*.po_out_date'        => ['label' => 'Out Date', 'rules' => 'required'],
            'outbound.*.customer_name'      => ['label' => 'Nama Penerima', 'rules' => 'required'],
            'outbound.*.customer_phone'     => ['label' => 'No Telp Penerima', 'rules' => 'required'],
            'outbound.*.customer_email'     => ['label' => 'Email Penerima', 'rules' => 'required'],
            'outbound.*.customer_address'   => ['label' => 'Alamat Penerima', 'rules' => 'required'],
            'outbound.*.zip_code'           => ['label' => 'Kode POS', 'rules' => 'required']
        ]);
        if(!$validation){
            session()->setFlashdata('message', '<div class="alert alert-custom alert-light-warning fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">The Excel file you uploaded contains some errors.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');
            return redirect()->to(base_url('outboundpo/bulk_upload'));
        }else{
            $outboundpo_id ="";
            $i=0;
            // var_dump($this->request->getPost('po')); die;
            $outbound_detail = $this->request->getPost('outbound_detail');
            // PENTING!!! JANGAN LUPA BUAT VALIDASI SQL INJECTION
            foreach ($this->request->getPost('outbound') as $row) {
                if($row['warehouse_id'] != 'PO_DETAIL'){
                    $customer_phone = $row['customer_phone'];
                    $zip_code = $row['zip_code'];
                    $customer_id = @$this->customer->get_customer_byphone($customer_phone)->customer_id;
                    // var_dump($zip_code);die;
                    $transporter = $this->outbound->get_transporter_byalias($row['transporter_alias']);
                    
                    if($customer_id == null || $customer_id == ""){
                        $customer_id = $this->customer->generate_id();
                        $states_data = @$this->state->getAllByZipCode($zip_code);

                        $data_customer = [
                            'customer_id' => $customer_id,
                            'customer_name' => $row['customer_name'],
                            'customer_address' => $row['customer_name'],
                            'state_id' => $states_data->state_id,
                            'city_id' => $states_data->city_id,
                            'district_id' => $states_data->district_id,
                            'sdistrict_id' => $states_data->sdistrict_id,
                            'customer_phone' => $customer_phone,
                            'customer_email' => $row['customer_email'],
                            'owners_id' => session()->get('owners_id'),
                            'status' => 1,
                            'create_date' => date('Y-m-d H:i:s'),
                            'create_by' => session()->get('fullname')
                        ];
                        $this->customer->insert_data($data_customer);
                    } 

                    $outboundpo_id = $this->outbound->generate_id();
                    
                    $data_outbound = [
                        'po_outbound_id' => $outboundpo_id,
                        'po_outbound_doc_date' => date('Y-m-d'), //otomatis
                        'po_out_date' => date_format(date_create($row['po_out_date']), 'Y-m-d'),
                        'po_description' => $row['po_description'], 
                        'po_penerima' => $customer_id,
                        'warehouse_id' => $row['warehouse_id'], 
                        'transporter_id' => @$transporter->transporter_id,
                        'owners_id' => session()->get('owners_id'),
                        'po_outbound_type' => 'TY003',
                        'po_out_status' => 1,
                        'po_create_date' => date('Y-m-d H:i:s'),
                        'po_create_by' => session()->get('fullname')
                    ];
                    // if($data_outbound['po_outbound_id'])
                    $this->outbound->insert_data($data_outbound);
                }
                $material_price = $this->material_detail->get_material_price($outbound_detail[$i]['material_id'], session()->get('owners_id'))->material_price;

                $detil_id = $this->outbound_detail->generate_id();
                $qty = str_replace(",", "", $outbound_detail[$i]['outbound_qty']);
                $data_outbound_detail = [
                    'po_det_outbound_id' => $detil_id,
                    'po_outbound_id' => $outboundpo_id,
                    'material_id' => $outbound_detail[$i]['material_id'],
                    'material_price' => $material_price,
                    'outbound_qty' => $qty,
                    'qty_good' => $qty,
                    'status' => 1
                ];

                $this->outbound_detail->insert_data($data_outbound_detail);
                $i++;
            }
        }
        session()->setFlashdata('message', '<div class="alert alert-custom alert-light-success fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Transactions successfully added.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');
        return redirect()->to(base_url('outboundpo'));
    }

    public function create(){
        $data = [
            'title' => 'Outbound',
            'sidebar' => 'Outbound'
        ];

        // var_dump(@$this->request->getPost('add_pack_box'));
        // var_dump(@$this->request->getPost('pm_id'));
        // var_dump(@$this->request->getPost('pm_qty'));
        // var_dump(@$this->request->getPost('pm_rate'));
        // die;

        

        if(intVal($this->request->getPost('add')) == 0){        
            $validate = $this->validate([
                'warehouse_id' => ['label' => 'Warehouse', 'rules' => 'required'],
                'customer_id' => ['label' => 'Customer Name', 'rules' => 'required'],
                'owner_id' => ['label' => 'PIC Name', 'rules' => 'required'],
                'material_id.*'=> ['label' => 'Product', 'rules' => 'required'],
                'quantity.*'=> ['label' => 'Quantity', 'rules' => 'required']
            ]);
        } else {
            $validate = $this->validate([
                'warehouse_id' => ['label' => 'Warehouse', 'rules' => 'required'],
                // 'customer_id' => ['label' => 'Customer Name', 'rules' => 'required'],
                'owner_id' => ['label' => 'PIC Name', 'rules' => 'required'],
                'material_id.*'       => ['label' => 'Product', 'rules' => 'required'],
                'quantity.*'        => ['label' => 'Quantity', 'rules' => 'required'],
                'customer_name' => ['label' => 'Customer Name', 'rules' => 'required'],
                'customer_address' => ['label' => 'Customer Address', 'rules' => 'required'],
                'state_id' => ['label' => 'Province', 'rules' => 'required'],
                'city_id' => ['label' => 'City', 'rules' => 'required'],
                'district_id' => ['label' => 'District', 'rules' => 'required'],
                'sdistrict_id' => ['label' => 'Sub District', 'rules' => 'required'],
                'pic_phone' => ['label' => 'Customer Phone', 'rules' => 'required'],
                'pic_email' => ['label' => 'Customer Email', 'rules' => 'required|valid_email']
            ]);
        }
        // var_dump($this->request->getPost('out_date'));die;
        $out_date = $this->request->getPost('out_date');
        if (!$validate) {
            return redirect()->to(base_url('/outboundpo/add'))->withInput();
        } else{

            $customer_id = '';

            if(intVal($this->request->getPost('add')) == 1){
                $customer_id = $this->customer->generate_id();
                $data_customer = [
                    'customer_id' => $customer_id,
                    'customer_name' => $this->request->getPost('customer_name'),
                    'customer_address' => $this->request->getPost('customer_address'),
                    'state_id' => $this->request->getPost('state_id'),
                    'city_id' => $this->request->getPost('city_id'),
                    'district_id' => $this->request->getPost('district_id'),
                    'sdistrict_id' => $this->request->getPost('sdistrict_id'),
                    'customer_phone' => $this->request->getPost('pic_phone'),
                    'customer_email' => $this->request->getPost('pic_email'),
                    'owners_id' => session()->get('owners_id'),
                    'status' => 1,
                    'create_date' => date('Y-m-d H:i:s'),
                    'create_by' => session()->get('fullname')
                ];
                $this->customer->insert_data($data_customer);
            } else {
                $customer_id = $this->request->getPost('customer_id');
            }
            $id = $this->outbound->generate_id();
            
            $data_outbound = [
                'po_outbound_id' => $id,
                'po_outbound_doc_date' => date_format(date_create($this->request->getPost('doc_date')), 'Y-m-d'), //otomatis
                'po_out_date' => date_format(date_create($out_date), 'Y-m-d'),
                // 'po_outbound_doc' => $this->request->getPost('doc_number'),
                'po_description' => $this->request->getPost('description'), //
                'po_penerima' => $customer_id,
                'warehouse_id' => $this->request->getPost('warehouse_id'), //
                'owners_id' => $this->request->getPost('owner_id'),
                'po_outbound_type' => 'TY003',
                'po_out_status' => 1,
                'po_create_date' => date('Y-m-d H:i:s'),
                'po_create_by' => session()->get('fullname')
            ];

            $this->outbound->insert_data($data_outbound);

            // contoh insert bill
            // $bill_id = $this->bill->generate_id();
            // $data_bill = [
            //     'bill_id' => $bill_id,
            //     'owners_id' => $this->request->getPost('owner_id'),
            //     'description' => 'BIAYA OUTBOUND',
            //     'amount' => $outbound_charge,
            //     'created_date' => date('Y-m-d H:i:s'),
            //     'bill_status' => 0
            // ];

            // $this->bill->insert_data($data_bill);

            if(@$this->request->getPost('material_id')){
                $i=0;
                foreach($this->request->getPost('material_id') as $row){
                    $detil_id = $this->outbound_detail->generate_id();
                    $data_outbound_detail = [
                        'po_det_outbound_id' => $detil_id,
                        'po_outbound_id' => $data_outbound['po_outbound_id'],
                        'material_id' => $row,
                        'outbound_qty' => $this->request->getPost('quantity['.$i.']'),
                        'qty_good' => $this->request->getPost('quantity['.$i.']'),
                        // 'location_id' => $this->request->getPost('location['.$i.']'),
                        'status' => 1
                    ];
                    $i++;
                    $this->outbound_detail->insert_data($data_outbound_detail);
                }
            }

            session()->setFlashdata('message', '<div class="alert alert-custom alert-light-success fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Outbound successfully added.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');

            return redirect()->to(base_url('outboundpo'));

        }
    }

    public function create_courier() {
        $data = [
            'title' => 'Outbound',
            'sidebar' => 'Outbound'
        ];

        
        if ($this->request->getPost('transaction_from') == 'Non Marketplace') {
            $validate = $this->validate([
                'transporter_id' => ['label' => 'Courier', 'rules' => 'required']
                // 'service_id' => ['label' => 'delivery service', 'rules' => 'required'],
                // 'serviceName' => ['label' => 'delivery service', 'rules' => 'required']
            ]);
        }else {
            $validate = $this->validate([
                'resi_number' => ['label' => 'Resi Number', 'rules' => 'required'],
                'transporter_name' => ['label' => 'Courier', 'rules' => 'required'],
            ]);
        }
        // var_dump($this->request->getPost('insurance_check')); die;

        if (!$validate) {
            return redirect()->to(base_url('outboundpo/add_courier/'.$this->request->getPost('po_outbound_id')))->withInput();
        }else{
            if ($this->request->getPost('transaction_from') == 'Non Marketplace') { // ubah disini
                $insurance = 0;
                $insuranceTax = 0;
                $totalFee = 0;
                if($this->request->getPost('insurance_check') == null){
                    if($this->request->getPost('transporter_id') == 1){
                        $insurance = 0;
                        $insuranceTax = 0;
                        $totalFee = floatVal($this->request->getPost('totalFee')) - (floatVal($this->request->getPost('insurance')) + floatVal($this->request->getPost('insuranceTax')));
                    } else {
                        $insurance = 0;
                        $insuranceTax = 0;
                        $totalFee = floatVal($this->request->getPost('totalFee'));
                    }
                } else {
                    if($this->request->getPost('transporter_id') == 1){
                        $insurance = $this->request->getPost('insurance');
                        $insuranceTax = $this->request->getPost('insuranceTax');
                        $totalFee = floatVal($this->request->getPost('totalFee'));
                    } else {// kondisi ketika sicepat.
                        $insurance = floatVal($this->request->getPost('price_tot')) * 0.0025;
                        $insurance = round($insurance);
                        $totalFee = floatVal($this->request->getPost('totalFee')) + $insurance;
                    }
                }
                $data_service = [
                    'po_outbound_id' => $this->request->getPost('po_outbound_id'),
                    'serviceCode' => $this->request->getPost('service_id'),
                    'serviceName' => $this->request->getPost('serviceName'),
                    'fee' => $this->request->getPost('fee'),
                    'feeTax' => $this->request->getPost('feeTax'),
                    'insurance' => $insurance,
                    'insuranceTax' => $insuranceTax,
                    'totalFee' => $totalFee,
                    'itemValue' => $this->request->getPost('itemValue'),
                    'notes' => $this->request->getPost('notes'),
                    'create_date' => date('Y-m-d H:i:s'),
                ];
    
                $this->outbound->insert_data_po_service($data_service);

                $data_outbound = [
                    'transporter_id' => $this->request->getPost('transporter_id')
                ];
            }else{
                $data_outbound = [
                    'po_resi_number' => $this->request->getPost('resi_number'),
                    'transporter_marketplace' => $this->request->getPost('transporter_name')
                ];
            }

            $this->outbound->update_data($this->request->getPost('po_outbound_id'), $data_outbound);

            session()->setFlashdata('message', '<div class="alert alert-custom alert-light-success fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Outbound successfully added.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');

            return redirect()->to(base_url('outboundpo'));
        }
    }

    public function invoice($id)
    {
        $data = [
            'title' => 'Outbound',
            'title_menu' => 'Outbound',
            'sidebar' => 'Outbound'
        ];	

		$dataObject = [
			'validation' => \Config\Services::validation(),
            'bill' => $this->bill->get_bill_bypo_id_report($id),
            'po_data' => $this->outbound->get_outbound_byid($id)
		];

		echo view('layout/header', $data);
		echo view('bill/owners_bill', $dataObject);
		echo view('layout/footer');
    }

    public function accept_invoice(){
        $id = $this->request->getGet('bill_id'); // ini isinya id po outbound
        
        $bill = $this->bill->get_bill_bypo_id($id);
        $po_data = $this->outbound->get_outbound_byid($id); // ini pake model outbound po
        $owners_balance = $this->owner->get_owner_byid($po_data->owners_id)->owners_balance;
        $total_amount = 0;

        $data = [
            'bill_status' => 1
        ];
        if (@$bill) {
            $no = 0;
            foreach ($bill as $row) {
                $total_amount = $total_amount + $row->amount;
            }
        }

        $balance_updated = $owners_balance - $total_amount;

        $data_owner = [
            'owners_balance' => $balance_updated
        ];

        $real_data_outbound = [
            'status' => 5
        ];

        $data_outbound = [
            'po_out_status' => 5
        ];
        $balance = intVal($this->owner->get_owner_byid(session()->get('owners_id'))->owners_balance) - 100000;
        if($total_amount > $balance){
            session()->setFlashdata('message', '<div class="alert alert-custom alert-light-danger fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Not enough balance.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');
            return redirect()->to(base_url('/outboundpo/invoice/'.$id))->withInput();
        }
        $result = $this->bill->update_data_byPO($id, $data);   
        $result_outbound = $this->outbound->update_data($id, $data_outbound);
        $result_real_outbound = $this->real_outbound->update_data_bypo($id, $real_data_outbound);
        $resultOwners = $this->owner->update_data($po_data->owners_id, $data_owner);

        session()->setFlashdata('message', '<div class="alert alert-custom alert-light-success fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Invoice successfully approved.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');

        return redirect()->to(base_url('outboundpo'));
    }

    public function reject_invoice(){
        $id = $this->request->getGet('bill_id');
        
        $bill = $this->bill->get_bill_bypo_id($id);
        $po_data = $this->outbound->get_outbound_byid($id);
        $owners_balance = $this->owner->get_owner_byid($po_data->owners_id)->owners_balance;

        $data = [
            'bill_status' => 2
        ];

        $real_data_outbound = [
            'status' => 6
        ];

        $data_outbound = [
            'po_out_status' => 6
        ];
        
        $result = $this->bill->update_data_byPO($id, $data);   
        $result_outbound = $this->outbound->update_data($id, $data_outbound);
        $result_real_outbound = $this->real_outbound->update_data_bypo($id, $real_data_outbound);

        session()->setFlashdata('message', '<div class="alert alert-custom alert-light-danger fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Invoice rejected.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');

        return redirect()->to(base_url('outboundpo'));
    }

    public function finish_po(){
        $id = $this->request->getGet('po_outbound_id');
        $outbound_id = $this->real_outbound->get_outbound_bypo($id)->outbound_id;
        $do_id = $this->outbounddo_detail->get_shippingid_byoutbound($outbound_id)->do_id;

        $check_outbound = $this->outbounddo_detail->checkDoDetail($do_id, $outbound_id);
        // print_r($check_outbound);
        // die;
        if($check_outbound == 0){
            $data_shipping = [
                'do_status' => 5
            ];
            $result_outbounddo = $this->outbounddo->update_data($do_id, $data_shipping);
        }
        // ambil dulu shipping id nya #1(buat fungsi di model get shipping by outbound id), dari situ cek apakah ada outbound id yang 
        // status nya belom done selain id yang lagi di-approve sekarang. kalo gaada maka ubah status shipping dari in progress
        // ke done

        $real_data_outbound = [
            'status' => 7
        ];

        $data_outbound = [
            'po_out_status' => 7
        ];

        $result_outbound = $this->outbound->update_data($id, $data_outbound);
        $result_real_outbound = $this->real_outbound->update_data_bypo($id, $real_data_outbound);

        session()->setFlashdata('message', '<div class="alert alert-custom alert-light-success fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Request Done.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');

        return redirect()->to(base_url('outboundpo'));
    }

    public function detail($id)
	{
		$data = [
            'title' => 'Outbound',
            'title_menu' => 'Outbound',
            'sidebar' => 'Outbound'
        ];	

		$dataObject = [
			'validation' => \Config\Services::validation(),
            'data_outbound' => $this->outbound->get_outbound_byid($id),
            'data_awb' => $this->outbounddo->get_awbNumber($id),
            'outbound_detail' => $this->outbound->get_outbound_detail($id),
            'data_history' => $this->outbound->get_fulfillment_time_record($id)
		];

        // print_r($dataObject['data_outbound']);exit();
		echo view('layout/header', $data);
		echo view('outbound/detail_po', $dataObject);
		echo view('layout/footer');
	}

    public function tracking($id = NULL) {
        $data = [
            'title' => 'Outbound',
            'title_menu' => 'Outbound',
            'sidebar' => 'Outbound'
        ];	
        $data_outbound = $this->outbound->get_outbound_byid($id);
        $data_awb = $this->outbounddo->get_awbNumber($id);
        $api_pos_token = $this->outbound->api_pos_token();
		$dataObject = [
			'validation' => \Config\Services::validation(),
            'data_outbound' => $data_outbound,
            'data_awb' => $data_awb,
            'outbound_detail' => $this->outbound->get_outbound_detail($id),
            'po_service' => $this->outbound->get_byid_po_service($id),
            'transporter' => $this->outbound->get_byid_transporter($data_outbound->transporter_id),
            'api_pos_trackandtrace' => $this->outbound->api_pos_trackandtrace($data_awb->do_out_resi, $api_pos_token->access_token)
		];

		echo view('layout/header', $data);
		echo view('outbound/tracking_po', $dataObject);
		echo view('layout/footer');
    }

    public function delete(){
        $id = $this->request->getGet('id');

        $result = $this->outbound_detail->delete_data($id);

        $result1 = $this->outbound->delete_data($id);
        $this->outbound->delete_data_po_service($id);

        session()->setFlashdata('message', '<div class="alert alert-custom alert-light-success fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Outbound successfully inactivated.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>');

        return redirect()->to(base_url('outbound'));
    }

    function get_material_byowner(){
        $owner_id = $this->request->getPost('owner_id');
        $warehouse_id = $this->request->getPost('warehouse_id');
        $data = $this->material_detail->get_all_material_byowner($owner_id, $warehouse_id);
        echo json_encode($data);
    }

    function get_outbound_byid(){
        $po_outbound_id = $this->request->getPost('po_outbound_id');
        $data = $this->outbound->get_outbound_byid($po_outbound_id);
        echo json_encode($data);
    }

    function get_outbound_detail(){
        $po_outbound_id = $this->request->getPost('po_outbound_id');
        $data = $this->outbound->get_outbound_detail($po_outbound_id);
        echo json_encode($data);
    }

    function get_location_bymaterial(){
        $owner_id = $this->request->getPost('owner_id');
        $warehouse_id = $this->request->getPost('warehouse_id');
        $material_id = $this->request->getPost('material_id');
        $data = $this->material_detail->get_location_bymaterial($owner_id, $warehouse_id, $material_id);
        echo json_encode($data);
    }

    function get_qty_bylocation(){
        $owner_id = $this->request->getPost('owner_id');
        $warehouse_id = $this->request->getPost('warehouse_id');
        $material_id = $this->request->getPost('material_id');
        $data = $this->material_detail->get_qty_bylocation_po($owner_id, $warehouse_id, $material_id);
        echo json_encode($data);
    }

    function get_qty_bylocation_po(){
        $owner_id = $this->request->getPost('owner_id');
        $warehouse_id = $this->request->getPost('warehouse_id');
        $material_id = $this->request->getPost('material_id');
        $data = $this->material_detail->get_qty_bylocation_po_ng($owner_id, $warehouse_id, $material_id);
        echo json_encode($data);
    }

    public function get_courier_service() {
        $customer_id = @$this->request->getGet('customer_id');
        $warehouse_id_outboundpo = @$this->request->getGet('warehouse_id_outboundpo');
        $transporter_id = @$this->request->getGet('transporter_id');
        $outbound_qty_tot = @$this->request->getGet('outbound_qty_tot');

        $po_outbound_id = @$this->request->getGet('po_outbound_id');
        $price_tot = @$this->request->getGet('price_tot');
        $service_id = @$this->request->getGet('service_id');
        $weight_tot = @$this->request->getGet('weight_tot');

        $height_tot = 0;
        $length_tot = 0;
        $width_tot = 0;
        $po_outbound_data = $this->outbound->get_outbound_byid($po_outbound_id);
        // var_dump(@$po_outbound_data);
        // kondisi dibawah untuk: jika po outbound memakai kardus, maka dimensi yang dihitung untuk
        // API Posindo adalah dimensi dari kardusnya.
        // note: apabila volumenya lebih besar tapi p atau l atau t kardus nya lebih kecil dari total dimensi product, 
        // apakah harus pilih kardus yang p atau l atau t nya lebih besar? 
        if(intVal(@$po_outbound_data->use_box) == 1){ 
            $data_kardus = $this->pm->get_pm_kardus_byoutbound($po_outbound_id);
            $height_tot = $data_kardus->pm_height;
            $length_tot = $data_kardus->pm_length;
            $width_tot = $data_kardus->pm_width;
        } else {
            $height_tot = @$this->request->getGet('height_tot');
            $length_tot = @$this->request->getGet('length_tot');
            $width_tot = @$this->request->getGet('width_tot');
        } 
        
        $get_byid_customer = $this->outbound->get_byid_customer($customer_id, session()->get('owners_id'));
        $get_byid_warehouse = $this->outbound->get_byid_warehouse($warehouse_id_outboundpo);
        
        if ($transporter_id == '1') {
            $api_pos_token = $this->outbound->api_pos_token();
            $result = $this->outbound->api_pos_kurir($get_byid_customer, $get_byid_warehouse, $outbound_qty_tot, $weight_tot, $height_tot, $length_tot, $width_tot, $price_tot, $customer_id, @$api_pos_token->access_token);
            foreach (@$result->response->data as $value) {
                
                if ($service_id == $value->serviceCode) {
                    echo '<input type="hidden" name="serviceName" id="serviceName" value="'.@$value->serviceName.'"/>';
                    echo '<input type="hidden" name="fee" id="fee" value="'.@$value->fee.'"/>';
                    echo '<input type="hidden" name="feeTax" id="feeTax" value="'.@$value->feeTax.'"/>';
                    echo '<input type="hidden" name="insurance" id="insurance" value="'.@$value->insurance.'"/>';
                    echo '<input type="hidden" name="insuranceTax" id="insuranceTax" value="'.@$value->insuranceTax.'"/>';
                    echo '<input type="hidden" name="totalFee" id="totalFee" value="'.@$value->totalFee.'"/>';
                    echo '<input type="hidden" name="itemValue" id="itemValue" value="'.@$value->itemValue.'"/>';
                    echo '<input type="hidden" name="notes" id="notes" value="'.@$value->notes.'"/>';
                }elseif ($service_id == NULL) {
                    echo '<option value="" selected></option>';
                    echo '<option value="'.$value->serviceCode.'">'.$value->serviceName.' - Rp.'.number_format($value->totalFee).'</option>';
                }
            }
        }

        if ($transporter_id == '4') {
            $result = $this->outbound->api_sicepat_kurir($get_byid_warehouse->origin_code_sicepat, $get_byid_customer->destination_code_sicepat, $weight_tot);
            
            foreach (@$result->sicepat->results as $value) {
                if ($service_id == $value->service) {
                    echo '<input type="hidden" name="serviceName" id="serviceName" value="'.@$value->description.'"/>';
                    echo '<input type="hidden" name="fee" id="fee" value=""/>';
                    echo '<input type="hidden" name="feeTax" id="feeTax" value=""/>';
                    echo '<input type="hidden" name="insurance" id="insurance" value=""/>';
                    echo '<input type="hidden" name="insuranceTax" id="insuranceTax" value=""/>';
                    echo '<input type="hidden" name="totalFee" id="totalFee" value="'.@$value->tariff.'"/>';
                    echo '<input type="hidden" name="itemValue" id="itemValue" value=""/>';
                    echo '<input type="hidden" name="notes" id="notes" value=""/>';
                }elseif ($service_id == NULL) {
                    echo '<option value="" selected></option>';
                    echo '<option value="'.@$value->service.'">'.@$value->description.' - '.@$value->etd.' - Rp.'.number_format(@$value->tariff).'</option>';
                }
            }
        }

        if ($transporter_id == '3') {
            $result = $this->outbound->api_jne_kurir($get_byid_warehouse->origin_code_sicepat, $get_byid_customer->destination_code_sicepat, $weight_tot);
            
            foreach (@$result->price as $value) {
                if ($service_id == $value->service_code) {
                    echo '<input type="hidden" name="serviceName" id="serviceName" value="'.@$value->service_display.'"/>';
                    echo '<input type="hidden" name="fee" id="fee" value=""/>';
                    echo '<input type="hidden" name="feeTax" id="feeTax" value=""/>';
                    echo '<input type="hidden" name="insurance" id="insurance" value=""/>';
                    echo '<input type="hidden" name="insuranceTax" id="insuranceTax" value=""/>';
                    echo '<input type="hidden" name="totalFee" id="totalFee" value="'.@$value->price.'"/>';
                    echo '<input type="hidden" name="itemValue" id="itemValue" value=""/>';
                    echo '<input type="hidden" name="notes" id="notes" value=""/>';
                }elseif ($service_id == NULL) {
                    echo '<option value="" selected></option>';
                    echo '<option value="'.@$value->service_code.'">'.@$value->service_display.' - '.@$value->etd_from.' - '.@$value->etd_thru.' - Rp.'.number_format(@$value->price).'</option>';
                }
            }
        }
    }

    public function get_packing_kardus() {
        $total_all_volume = @$this->request->getGet('total_all_volume');
        $pm = $this->pm->get_all_pm_not_kardus();
        $pm_kardus = $this->pm->get_all_pm_kardus();
        var_dump($total_all_volume); 
        foreach ($pm as $key => $value) {
            echo '<option value="'.$value->id.'" data-id="'.$value->pm_rate.'">'.$value->pm_name.'</option>';
        }

        // foreach ($pm_kardus as $key => $value) {
        //     $volume_kardus = $value->pm_length * $value->pm_width * $value->pm_height;
        //     if ($volume_kardus >= $total_all_volume) {
        //         echo '<option value="'.$value->id.'" data-id="'.$value->pm_rate.'">'.$value->pm_name.'</option>';
        //     }
        // }
    }

    public function get_packing_kardus_ver2(){
        $total_all_volume = @$this->request->getGet('total_all_volume');
        $pm = $this->pm->get_all_pm_not_kardus();
        $pm_kardus = $this->pm->get_all_pm_kardus();
        $json = "";
        // var_dump($total_all_volume);
        $pilih_kardus = 0;
        foreach ($pm_kardus as $key => $value) {
            $volume_kardus = $value->pm_length * $value->pm_width * $value->pm_height;
            if ($volume_kardus >= $total_all_volume) {
                if($pilih_kardus < 1){
                    // $json = '<option value="'.$value->id.'" data-id="'.$value->pm_rate.'" checked>'.$value->pm_name.'</option>';
                    $json = '<div class="form-group row">
                    <div class="col-4">
                        <label class="font-weight-bold">Packaging Material<span class="text-danger">*</span></label>
                        <input type="text" hidden readonly class="form-control form-control-solid numbers" value="'.  $value->id .'" name="pm_id[]" placeholder="Material ID">
                        <input type="text" readonly class="form-control form-control-solid numbers" value="'.  $value->pm_name .'" placeholder="Material ID">
                    </div>
                    <div class="col-4">
                        <label class="font-weight-bold">Quantity<span class="text-danger">*</span></label>
                        
                        <input type="text" readonly class="form-control form-control-solid" 
                            name="pm_qty[]" value="1" onchange="hitung_total(0);hitung_material();" onkeypress="return CheckNumeric()" >
                        

                    </div>
                    <div class="col-4">
                        <label class="font-weight-bold">Rate each material<span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    Rp.
                                </span>
                            </div>
                            <input type="hidden" id="subprice0" />
                            <input type="text" required class="form-control form-control-solid numbers" value="'.$value->pm_rate.'" name="pm_rate[]" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this);" readonly placeholder="Rate for Each Product">
                        </div>
                    </div>
                    <div class="col-1">
                        
                    </div>
                </div>';
                }
                $pilih_kardus++;
            }
        }

        if($pilih_kardus < 1){
            $json = '<div class="alert alert-custom alert-light-warning fade show mb-5" role="alert"><div class="alert-icon"><i class="flaticon-warning"></i></div><div class="alert-text">Box with this size is not available.</div><div class="alert-close"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true"><i class="ki ki-close"></i></span></button></div></div>';
        }

        echo $json;
    }
}
?>