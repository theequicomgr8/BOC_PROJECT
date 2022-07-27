<nav id="sidebar">
  <div class="sidebar-header">
    <!--<h3>Bootstrap Sidebar </h3>-->
    <h3 class="inside-logo">
      <img class="logo" style=' {{ strlen(Session::get('HeadName')) >27 ? "vertical-align: bottom ": "vertical-align: middle"}}' src="{{asset('theme/images/logo-s.png')}}" /> <span class="mt-3">@if(Session::has('HeadName'))
        {{ Session::get('HeadName')}}
        @endif</span></h3>
  </div>

  <div class="p-3">
    <i class="fa fa-fw fa-align-left"></i> My Menu</p>
    @if(Session::get('UserType')==0)
      <a href="{{url('client-submission-list')}}"><i class="fa fa-fw fa-home"></i>Dashboard</a>
    @else
      <?php
        
       
        if(Session::get('WingType')==0 && Session::get('UserType')==1)
        {
          $wing_type_name = '- Outdoor';
          $wing_name = 'Outdoor ';
        }
        else if(Session::get('WingType')==1)
        {
          $wing_type_name = '- Personal Media';
          $wing_name = 'Personal Media ';
        }
        else if(Session::get('WingType')==2)
        {
          $wing_type_name = '- Category-C';
          $wing_name = 'Category-C';
        }
        else if(Session::get('WingType')==3)
        {
          $wing_type_name = '- Print';
          $wing_name = 'Print';
        }
        else if(Session::get('WingType')==4)
        {
          $wing_type_name = '- AV-TV';
          $wing_name = 'AV-TV';
        }
        else if(Session::get('WingType')==5)
        {
          $wing_type_name = '- AV-Radio';
          $wing_name = 'AV-Radio';
        }
        else if(Session::get('WingType')==7)
        {
          $wing_type_name = '- AV-Producers';
          $wing_name = 'AV-Producers';
        }
        else if(Session::get('WingType')==8)
        {
          $wing_type_name = '- Digital Cinema';
          $wing_name = 'Digital Cinema';
        }
        else if(Session::get('WingType')==9)
        {
          $wing_type_name = '- Internet Website';
          $wing_name = 'Internet Website';
        }
        else if(Session::get('WingType')==10)
        {
          $wing_type_name = '- Bulk SMS';
          $wing_name = 'Bulk SMS';
        }
        else if(Session::get('WingType')==11)
        {
          $wing_type_name = '- Printed Publicity';
          $wing_name = 'Printed Publicity';
        }
        else
        {
          $wing_type_name = '';
          $wing_name = '';
        }
      ?>

      <a href="{{url('dashboard')}}"><i class="fa fa-fw fa-home"></i>Dashboard {{$wing_type_name}} </a>
    @endif
    <ul class="list-unstyled components mb-5">
      @if(Session::get('UserType')==0)
      <!-- <li>
        <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-user" aria-hidden="true"></i> Media Request</a>
        <ul class="collapse list-unstyled" id="homeSubmenu">
          <li>
            <a href="{{ url('client-submission-list') }}"><i class="fa fa-undo" aria-hidden="true"></i> View Previous Requests</a>
          </li>
          <li>
            <a href="{{ url('client-submission-form') }}"><i class="fa fa-user-plus" aria-hidden="true"></i> Add New Request</a>
          </li>
        </ul>
      </li> -->
      <li><a href="{{ url('fundstatus') }}"><i class="fa fa-inr" aria-hidden="true"></i> Fund Status</a></li>
     
      @endif

      @if(Session::get('UserType')==2)
      <li>
        <a href="{{ url('roblist') }}" class="nav-link">
          <i class="fa fa-angellist" aria-hidden="true"></i>
          Activity list
          </p>
        </a>
      </li>
      @endif
       
      @if(Session::get('UserType')==1)
      <li>
        @if(Session::get('WingType')==0)
        <!-- Soleright linking -->
        <a href="#solerightEmpanelment" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-angle-right" aria-hidden="true"></i> Outdoor</a>

        <ul class="collapse list-unstyled" id="solerightEmpanelment">
          <li>
            <a href="{{ url('sole-right-list') }}"><i class="fa fa-print"></i> Fresh Empanelment</a>
          </li>

          <li>
            <a href="{{ url('sole-right-list') }}"><i class="fa fa-edit"></i> Renewal</a>
          </li>

         <li>
            <a href="{{ url('ODMediaRO') }}"><i class="fa fa-angellist" aria-hidden="true"></i> RO List</a>
         </li>

          <li>
            <a href="{{ url('sole-right-list') }}"><i class="fa fa-upload"></i> Agreement of Fresh Empanelment</a>
          </li>
          <!-- <li>
                    <a href="{{ url('solerenewalAgreement') }}"><i class="fa fa-upload"></i> Agreement Of Renewal</a>
                  </li> -->
          <!-- <li>
            <a href="{{ route('ODMediaCompliance.create') }}"><i class="fa fa-angellist" aria-hidden="true"></i> Add Compliance</a>
          </li>
          <li>
            <a href="{{ route('ODMediaCompliance.index') }}"><i class="fa fa-angellist" aria-hidden="true"></i> Compliance List</a>
          </li> -->
          <li>
            <a href="{{ route('ODMediaBilling.index') }}"><i class="fa fa-angellist" aria-hidden="true"></i> Billing List</a>
          </li>
        </ul>
         @elseif(Session::get('WingType')==1)
        <!-- Personal linking -->
        <a href="#personalEmpanelment" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-angle-right" aria-hidden="true"></i>Personal Media</a>

        <ul class="collapse list-unstyled" id="personalEmpanelment">
          <li>
            <a href="{{ url('personal-list') }}"><i class="fa fa-print"></i> Fresh Empanelment</a>
          </li>

          <li>
            <a href="{{ url('personal-list') }}"><i class="fa fa-edit"></i> Renewal</a>
          </li>

         <li>
            <a href="{{ url('ODMediaRO') }}"><i class="fa fa-angellist" aria-hidden="true"></i> RO List</a>
         </li>

          <li>
            <a href="{{ url('personal-list') }}"><i class="fa fa-upload"></i> Agreement of Fresh Empanelment</a>
          </li>
          <!-- <li>
                    <a href="{{ url('personalrenewalAgreement') }}"><i class="fa fa-upload"></i> Agreement Of Renewal</a>
                  </li> -->
          <!-- <li>
            <a href="{{ route('ODMediaCompliance.create') }}"><i class="fa fa-angellist" aria-hidden="true"></i> Add Compliance</a>
          </li>
          <li>
            <a href="{{ route('ODMediaCompliance.index') }}"><i class="fa fa-angellist" aria-hidden="true"></i> Compliance List</a>
          </li> -->
          <li>
            <a href="{{ route('ODMediaBilling.index') }}"><i class="fa fa-angellist" aria-hidden="true"></i> Billing List</a>
          </li>
        </ul>

        <!-- Private linking -->
         @elseif(Session::get('WingType')==2)
        <a href="#personalEmpanelment" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-angle-right" aria-hidden="true"></i>Category-C</a>

        <ul class="collapse list-unstyled" id="personalEmpanelment">
          <li>
            <a href="{{ url('rate-settlement-private-media') }}"><i class="fa fa-print"></i> Fresh Empanelment</a>
          </li>

          <li>
            <a href="{{ url('private-renewal') }}"><i class="fa fa-edit"></i> Renewal</a>
          </li>

         <li>
            <a href="{{ url('ODMediaRO') }}"><i class="fa fa-angellist" aria-hidden="true"></i> RO List</a>
         </li>

          <li>
            <a href="{{ url('private-fileupload') }}"><i class="fa fa-upload"></i> Agreement of Fresh Empanelment</a>
          </li>
          <li>
                    <a href="{{ url('privaterenewalAgreement') }}"><i class="fa fa-upload"></i> Agreement of Renewal</a>
                  </li>
          <li>
            <a href="{{ route('ODMediaCompliance.create') }}"><i class="fa fa-angellist" aria-hidden="true"></i> Add Compliance</a>
          </li>
          <li>
            <a href="{{ route('ODMediaCompliance.index') }}"><i class="fa fa-angellist" aria-hidden="true"></i>Compliance List</a>
          </li>
          <li>
            <a href="{{ route('ODMediaBilling.index') }}"><i class="fa fa-angellist" aria-hidden="true"></i> Submitted Bill List</a>
          </li>
        </ul>
        @elseif(Session::get('WingType')==3)

        <a href="#printEmpanelment" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">{{$wing_name}} Management</a>

        <ul class="collapse list-unstyled" id="printEmpanelment">
          <li>
            <a href="{{ url('fresh-empanelment') }}"><i class="fa fa-print"></i> Fresh Empanelment</a>
          </li>

          <li>
            <a href="{{ url('print-renewal') }}"><i class="fa fa-edit"></i> Renewal</a>        
          </li>

         <li>
            <a href="{{ url('release-order-list') }}"><i class="fa fa-angellist" aria-hidden="true"></i> RO List</a>
         </li>

          <li>
            <a href="{{ url('file-upload') }}"><i class="fa fa-upload"></i> Agreement of Fresh Empanelment</a>
          </li>

          <li>
            <a href="{{ route('dailycompliance.create') }}"><i class="fa fa-angellist" aria-hidden="true"></i> Add Compliance</a>
          </li>
          <li>
            <a href="{{ route('dailycompliance.index') }}"><i class="fa fa-angellist" aria-hidden="true"></i> Compliance List</a>
          </li>
          <li>
            <a href="{{ route('billing.index') }}"><i class="fa fa-angellist" aria-hidden="true"></i> Submitted Bill List</a>
          </li>
        </ul>

        @elseif(Session::get('WingType')==4)

          <a href="#av_tvEmpanelment" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> AV-TV Management</a>

          <ul class="collapse list-unstyled" id="av_tvEmpanelment">
            <li>
              <a href="{{ url('form-type') }}"><i class="fa fa-user-plus"></i> Fresh Empanelment</a>
            </li>

            <li>
              <a href="{{ url('avtv-fileupload') }}"><i class="fa fa-upload"></i> Agreement of Fresh Empanelment</a>
            </li>

             <li>
              <a href="{{ url('radio-billing') }}"><i class="fa fa-angellist" aria-hidden="true"></i> Bill List</a>
            </li>
           
          
          </ul>
          @elseif(Session::get('WingType')==5)
          <a href="#pvtfmEmpanelment" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Private FM Management</a>

          <ul class="collapse list-unstyled" id="pvtfmEmpanelment">
            <li>
              <a href="{{ url('fm-radio-station') }}"><i class="fa fa-user-plus"></i> Fresh Empanelment</a>
            </li>

            <li>
              <a href="{{ url('fm-fileupload') }}"><i class="fa fa-upload"></i> Agreement of Fresh Empanelment</a>
            </li>

             <li>
              <a href="{{ url('radio-billing') }}"><i class="fa fa-angellist" aria-hidden="true"></i> Bill List</a>
            </li>
           
          </ul>
          @elseif(Session::get('WingType')==7)
          <a href="#avproducersEmpanelment" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">AV Producers Management</a>

          <ul class="collapse list-unstyled" id="avproducersEmpanelment">
            <li>
              <a href="{{ url('audio') }}"><i class="fa fa-user-plus"></i> Fresh Empanelment</a>
            </li>

            <li>
              <a href="{{ url('av-producer-fileupload') }}"><i class="fa fa-upload"></i> Agreement of Fresh Empanelment</a>
            </li>
            <li>
              <a href="{{ url('radio-billing') }}"><i class="fa fa-angellist" aria-hidden="true"></i> Bill List</a>
            </li>
          
          </ul>

          @elseif(Session::get('WingType')==8)
          <a href="#avproducersEmpanelment" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Digital Cinema</a>

          <ul class="collapse list-unstyled" id="avproducersEmpanelment">
            <li>
              <a href="{{ url('digital-cinema') }}"><i class="fa fa-user-plus"></i> Fresh Empanelment</a>
            </li>

            <li>
              <a href="{{ url('digital-agreement') }}"><i class="fa fa-upload"></i> Agreement of Fresh Empanelment</a>
            </li>
           
          </ul>
          @elseif(Session::get('WingType')==9)
          <a href="#avproducersEmpanelment" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Internet Website</a>

          <ul class="collapse list-unstyled" id="avproducersEmpanelment">
            <li>
              <a href="{{ url('internet-website') }}"><i class="fa fa-user-plus"></i> Fresh Empanelment</a>
            </li>

            <li>
              <a href="{{ url('intWeb-file-upload') }}"><i class="fa fa-upload"></i> Agreement of Fresh Empanelment</a>
            </li>
           
          </ul>
           @elseif(Session::get('WingType')==10)
          <a href="#avproducersEmpanelment" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Bulk SMS</a>

          <ul class="collapse list-unstyled" id="avproducersEmpanelment">
            <li>
              <a href="{{ url('bulk-sms') }}"><i class="fa fa-user-plus"></i> Fresh Empanelment</a>
            </li>

            <li>
              <a href="#"><i class="fa fa-upload"></i> Agreement of Fresh Empanelment</a>
            </li>
          
          </ul>
       <!--     @elseif(Session::get('WingType')==11)
          <a href="#avproducersEmpanelment" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-angle-right" aria-hidden="true"></i>Printed Publicity</a>

          <ul class="collapse list-unstyled" id="avproducersEmpanelment">
            <li>
              <a href="{{ url('audio') }}"><i class="fa fa-user-plus"></i> Fresh Empanelment</a>
            </li>

            <li>
              <a href="{{ url('av-producer-fileupload') }}"><i class="fa fa-upload"></i> Agreement of Fresh Empanelment</a>
            </li>
           
          
          </ul>   -->  
          @endif
        </li>

        @if(Session::get('WingType')==0 || Session::get('WingType')==1 || Session::get('WingType')==2)
         <li>
          <a href="{{ route('account-details') }}"><i class="fa fa-edit" aria-hidden="true"></i> Account Details</a>
        </li>
        @elseif(Session::get('WingType')==3)
         <li>
          <a href="{{ route('account-detail') }}"><i class="fa fa-edit" aria-hidden="true"></i> Account Detail</a>
        </li>
        @endif

        @if(Session::get('WingType')==0 || Session::get('WingType')==1 || Session::get('WingType')==2)
         <li>
          <a href="{{ route('company-details') }}"><i class="fa fa-edit" aria-hidden="true"></i> Company Details</a>
        </li>
        @elseif(Session::get('WingType')==3)
         <li>
          <a href="{{ route('basic-detail') }}"><i class="fa fa-edit" aria-hidden="true"></i> Company Detail</a>
        </li>
        @endif
      @endif
      @if(Session::get('UserType')==0)
      <li>
        <a href="{{URL::to('ministry-wise-client-code')}}" >Ministry Wise Client Code</a>
      </li>
      @endif

      
      @if(Session::get('UserType')==1)
      <li>
        <a href="#homeSubmenu2" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-print" aria-hidden="true"></i> Policies & Guidelines</a>
        <ul class="collapse list-unstyled" id="homeSubmenu2">
      

        @if(Session::get('WingType')==3)
          <li>
            <a target="_blank" href="{{URL::to('uploads/footer_document/PrintMedia/Print Media Advertisement Policy2O2O.pdf')}}"> 
               Print</a>
          </li>
        @endif


        @if(Session::get('WingType')==4 || Session::get('WingType')==5 || Session::get('WingType')==7)
          <li>
            <a href="#av_media" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> AV Media</a>
            <ul class="collapse list-unstyled" id="av_media">              
                <a href="#av_media2" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Community Radio Station</a> 
                  <ul class="collapse list-unstyled" id="av_media2">
                  <li>
                      <a target="_blank" href="{{URL::to('uploads/footer_document/AVMedia/Empanelment of Community Radio Station (CRS)2020.pdf')}}"> Guidelines of CRS</a>              
                  </li> 
                  <li>
                      <a target="_blank" href="{{URL::to('uploads/footer_document/AVMedia/Revision in the guidelines of Empanelment of Community Radio Station2022.pdf')}}"> Revision guidelines of CRS </a>              
                  </li>             
                  </ul>
                  <li>
                    <a target="_blank" href="{{URL::to('uploads/footer_document/AVMedia/Empanelment of Pvt. FM Stations2020.pdf')}}"> Guidelines of  Private FM</a>
                  </li>
                  <li>
                    <a target="_blank" href="{{URL::to('uploads/footer_document/AVMedia/Guidelines for Empanelment of AV Producers2011.pdf')}}"> Guidelines of AV Producer</a>
                  </li>
                  <li>
                    <a target="_blank" href="{{URL::to('uploads/footer_document/AVMedia/Pvt. C&S TV Policy Guidelines January 2019.pdf')}}"> Guidelines of AV-TV</a>
                  </li>
            </ul>
          </li>
        @endif


        @if((Session::get('WingType')==0 || Session::get('WingType')==1 || Session::get('WingType')==2) && Session::get('UserType')==1)
        <li>
                <a target="_blank" href="{{URL::to('uploads/footer_document/Outdoor/Policy Guidelines for Outdoor & Personal Media2021.pdf')}}"> Outdoor & Personal Media</a>
              </li>
              
          <!-- <li>
            <a href="#homeSubmenu3" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Outdoor</a>
            <ul class="collapse list-unstyled" id="homeSubmenu3">
              <li>
                <a target="_blank" href="{{URL::to('uploads/footer_document/Outdoor/Policy Guidelines for Outdoor & Personal Media2021.pdf')}}"> Outdoor & Personal Media</a>
              </li>
            </ul>
          </li> -->
        @endif


        @if(Session::get('WingType')==8 || Session::get('WingType')==9 || Session::get('WingType')==10)
          <li>
            <a href="#new_media" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> New Media</a>
            <ul class="collapse list-unstyled" id="new_media">
              <li>
                <a target="_blank" href="{{URL::to('uploads/footer_document/NewMedia/Policy Guidelines for Bulk SMS & Other Value Added Services2020.pdf')}}"> Guidelines of Bulk SMS</a>
              </li>
              <li>
                <a target="_blank" href="{{URL::to('uploads/footer_document/NewMedia/Policy Guidelines for Empanelment & Engagement of Social Media Platforms2020.pdf')}}"> Guidelines of Social Media</a>
              </li>
              <li>
                <a target="_blank" href="{{URL::to('uploads/footer_document/NewMedia/Policy Guidelines for Empanelment and Rate Fixation for Central Govt. Advertisements on Internet Websites2016.pdf')}}"> Guidelines of Internet Websites</a>
              </li>
              <li>
                <a target="_blank" href="{{URL::to('uploads/footer_document/NewMedia/Policy Guidelines for Empanelment of Digital Cinema2019.pdf')}}"> Guidelines of Digital Cinema</a>
              </li>
            </ul>
          </li>
        @endif


        @if(Session::get('WingType')==11)
          <li>
            <a href="#print_publisher" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Print Publisher</a>
            <ul class="collapse list-unstyled" id="print_publisher">
              <li>
                <a target="_blank" href="{{URL::to('uploads/footer_document/PrintPublicity_MassMailing/Empanelment of Offset PrintersDiary Makers & Digital Printers2018.pdf')}}"> Guidelines of  Digital Printers</a>
              </li>
              <li>
                <a target="_blank" href="{{URL::to('uploads/footer_document/PrintPublicity_MassMailing/Guidelines for empanelment of Offset Printers and Diary Makers with DAVP 2018.pdf')}}"> Guidelines of Offset Printer & Diary Makers</a>
              </li>

            </ul>
          </li>
        @endif
          
        </ul>
      </li>
    @endif
      @if(Session::get('UserType')==1)
      <!-- <li>
        <a href="#advisorieshomeSubmenu2" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-print" aria-hidden="true"></i> Advisories</a>
        <ul class="collapse list-unstyled" id="advisorieshomeSubmenu2">

        @if(Session::get('WingType')==3)
          <li>
            <a target="_blank" href="{{URL::to('uploads/footer_document/PrintMedia/Print Media Advertisement Policy2O2O.pdf')}}"> 
               Print</a>
          </li>
        @endif

        @if(Session::get('WingType')==4 || Session::get('WingType')==5 || Session::get('WingType')==7)
          <li>
            <a href="#advisoriesav_media" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> AV Media</a>
            <ul class="collapse list-unstyled" id="advisoriesav_media">              
                <a href="#advisoriesav_media2" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Community Radio Station</a> 
                  <ul class="collapse list-unstyled" id="advisoriesav_media2">
                  <li>
                      <a target="_blank" href="{{URL::to('uploads/footer_document/AVMedia/Empanelment of Community Radio Station (CRS)2020.pdf')}}"> Guidelines of CRS</a>              
                  </li> 
                  <li>
                      <a target="_blank" href="{{URL::to('uploads/footer_document/AVMedia/Revision in the guidelines of Empanelment of Community Radio Station2022.pdf')}}"> Revision guidelines of CRS </a>              
                  </li>             
                  </ul>
                  <li>
                    <a target="_blank" href="{{URL::to('uploads/footer_document/AVMedia/Empanelment of Pvt. FM Stations2020.pdf')}}"> Guidelines of  PVt. FM</a>
                  </li>
                  <li>
                    <a target="_blank" href="{{URL::to('uploads/footer_document/AVMedia/Guidelines for Empanelment of AV Producers2011.pdf')}}"> Guidelines of AV Producers</a>
                  </li>
                  <li>
                    <a target="_blank" href="{{URL::to('uploads/footer_document/AVMedia/Pvt. C&S TV Policy Guidelines January 2019.pdf')}}"> Guidelines of AV TV</a>
                  </li>
            </ul>
          </li>
          @endif

        @if(Session::get('WingType')==0 || Session::get('WingType')==1 || Session::get('WingType')==2)
          <li>
            <a href="#advisorieshomeSubmenu3" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Outdoor</a>
            <ul class="collapse list-unstyled" id="advisorieshomeSubmenu3">
              <li>
                <a target="_blank" href="{{URL::to('uploads/footer_document/Outdoor/Policy Guidelines for Outdoor & Personal Media2021.pdf')}}"> Outdoor & Personal Media</a>
              </li>
            </ul>
          </li>        
        @endif


        @if(Session::get('WingType')==8 || Session::get('WingType')==9 || Session::get('WingType')==10)
          <li>
            <a href="#advisoriesnew_media" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> New Media</a>
            <ul class="collapse list-unstyled" id="advisoriesnew_media">
              <li>
                <a target="_blank" href="{{URL::to('uploads/footer_document/NewMedia/Policy Guidelines for Bulk SMS & Other Value Added Services2020.pdf')}}"> Guidelines of Bulk SMS</a>
              </li>
              <li>
                <a target="_blank" href="{{URL::to('uploads/footer_document/NewMedia/Policy Guidelines for Empanelment & Engagement of Social Media Platforms2020.pdf')}}"> Guidelines of Social Media</a>
              </li>
              <li>
                <a target="_blank" href="{{URL::to('uploads/footer_document/NewMedia/Policy Guidelines for Empanelment and Rate Fixation for Central Govt. Advertisements on Internet Websites2016.pdf')}}"> Guidelines of Internet websites</a>
              </li>
              <li>
                <a target="_blank" href="{{URL::to('uploads/footer_document/NewMedia/Policy Guidelines for Empanelment of Digital Cinema2019.pdf')}}"> Guidelines of Digital Cinema</a>
              </li>
            </ul>
          </li>
        @endif

        @if(Session::get('WingType')==11)
          <li>
            <a href="#advisoriesprint_publisher" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Print Publisher</a>
            <ul class="collapse list-unstyled" id="advisoriesprint_publisher">
              <li>
                <a target="_blank" href="{{URL::to('uploads/footer_document/PrintPublicity_MassMailing/Empanelment of Offset PrintersDiary Makers & Digital Printers2018.pdf')}}"> Guidelines of  Digital Printers</a>
              </li>
              <li>
                <a target="_blank" href="{{URL::to('uploads/footer_document/PrintPublicity_MassMailing/Guidelines for empanelment of Offset Printers and Diary Makers with DAVP 2018.pdf')}}"> Guidelines of Offset Printer & Diary Makers</a>
              </li>

            </ul>
          </li>
        @endif
          
        </ul>
      </li> -->

    @endif
      @if(Session::get('UserType')==1)


        @if(Session::get('WingType') !=0 || Session::get('WingType') !=1 || Session::get('WingType') !=2)
      <li>
            <a href="#advisories_empaneled" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Empaneled Vendors</a>
            <ul class="collapse list-unstyled" id="advisories_empaneled">
              @if(Session::get('WingType')==8)
              <li>
                <a href="{{URL::to('uploads/footer_document/VendorsEmpaneled/Digital Cinema Vendors.xlsx')}}"> Digital Cinema Vendors</a>
              </li>
              @endif
              @if(Session::get('WingType')==3)
              <li>
                <a href="{{URL::to('uploads/footer_document/VendorsEmpaneled/Print Vendors.xlsx')}}"> Print Vendors</a>
              </li>
              @endif
              @if(Session::get('WingType')==4)
              <li>
                <a href="{{URL::to('uploads/footer_document/VendorsEmpaneled/TV Channels.xlsx')}}"> TV Channels</a>
              </li>
              @endif


            @if(Session::get('WingType')==9)
              <li>
                <a target="_blank" href="{{URL::to('uploads/footer_document/VendorsEmpaneled/Websites.pdf')}}"> Websites</a>
              </li>
            @endif
            </ul>
          </li>
        @endif
      @endif

      @if(Session::get('UserType')==0)
      <li>
        <a href="{{URL::to('uploads/footer_document/ClientFAQs.pdf')}}" >FAQs</a>
      </li>
      @elseif(Session::get('UserType')==1)
      <li>
        <a href="#" >Vendor FAQs</a>
      </li>
      @endif

      
    </ul>
    @if(Session::get('UserType')==0)
    
    <div class="footer">
      <a  class='btn btn-primary btn-sm m-0'  href="{{url('callbackrequest')}}">Request a Callback</a>
      </p>
    </div>
    @endif
  </div>
</nav>