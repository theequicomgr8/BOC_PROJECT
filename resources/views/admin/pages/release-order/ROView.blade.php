@extends('admin.layouts.layout')
<style>
  body{
    color: #6c757d !important;
  }

</style>
@section('content')
@php 
$results=isset($response)? $response:'';
//dd($results);
@endphp
<div class="content-inside p-3">
  <div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-normal text-primary">Release Order</h6> 
    </div>
    <!-- Card Body -->
    <div class="card-body">
     <div class="table-responsive">
       
              <div id="mydiv" align="center">


                <table id="Table1" class="table table-bordered" cellspacing="0" cellpadding="0" width="100%" align="center" border="0">
                  <tbody>
                    <tr>
                      <td style="text-align: center;"> 
                        <span class="dontprint">
                          &nbsp;&nbsp;<input type="submit" name="btn_bill_submit" value="Bill Submit" id="btn_bill_submit" class="btn" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <a onclick="getPrint('mydiv');" id="lbtnprint" href="javascript:__doPostBack('lbtnprint','')">Printable Version</a>&nbsp;
                          <a id="lbtninst" href="javascript:__doPostBack('lbtninst','')"></a><a href="http://www.davp.nic.in/upload/relinst.pdf"> R O Instructions </a>&nbsp;&nbsp;
                          <a id="lbtnback" href="javascript:__doPostBack('lbtnback','')">Back</a></span>
                        </td>
                      </tr>

                      <tr>
                        <td style="text-align: center;"> 
                          <span id="Label36" style="font-family:Verdana;font-size:9pt;">S/w Support by: </span><img id="Image1" src="{{asset('img/nicemb.gif')}}" border="0" style="height:48px;width:72px;">
                        </td>
                      </tr>
                      <tr> 
                        <td colspan="2" align="left">
                          <table width="100%" border="0" cellspacing="0" cellpadding="2">
                            <tbody> 
                              <tr>
                                <td colspan="2">
                                  <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                    <tbody><tr>
                                      <td align="left" valign="middle"><img src="{{asset('img/davp.jpg')}}" height="48" width="64"></td>
                                      <td align="center" class="MainHeading">
                                        <b>भारत सरकार<br>
                                          GOVERNMENT OF INDIA<br>
                                          विज्ञापन और दृश्य प्रचार निदेशालय, सूचना और प्रसारण मंत्रालय<br>
                                          DIRECTORATE OF ADVERTISING AND VISUAL PUBLICITY, M/O I&amp;B<br>
                                          सूचना भवन, फेस-4, सीजीओ कॉम्प्लेक्स, लोधी रोड, नई दिल्ली 110003<br>
                                        Soochana Bhawan,Phase 4, CGO Complex, Lodhi Road, New Delhi-110003</b>
                                      </td>
                                      <td align="right" valign="middle"><img src="{{asset('img/rocumbill.jpg')}}"></td>
                                    </tr>
                                  </tbody></table>
                                </td>
                              </tr>
                              <tr>
                                <td align="right" class="Content">
                                  आर ओ कोड<br>
                                  <span id="lblrocode" style="font-family:Verdana;font-size:8pt;">RO Code :{{ $results->{'RO Code'} }}</span>
                                  <br>
                                  दिनांक<br>
                                  <span id="lbldated" style="font-family:Verdana;font-size:8pt;">Dated :{{ date('d-M-Y', strtotime($results->{'RO Date'})) }}</span>
                                </td>
                                <td align="center" class="Content">
                                  वाउचर प्रति भेजने के लिए ग्राहक का पता<br>
                                Client Address for sending voucher copy</td>
                              </tr>
                              <tr>
                                <td colspan="2" class="Content">

                                </td>
                              </tr>
                              <tr>
                                <td class="Content"><span id="lblnpcode" style="font-family:Verdana;font-size:8pt;">100075 ENGLISH DAILY(M)</span>
                                  <br>
                                  The Advertisement Manager
                                  <br>
                                  <span id="lblnewspapername" style="font-family:Verdana;font-size:8pt;">THE HIMACHAL TIMES</span>
                                  <br>
                                  <span id="lbladd1" style="font-family:Verdana;font-size:8pt;">21,RAJPUR ROAD</span><br>
                                  <span id="lbladd2" style="font-family:Verdana;font-size:8pt;">DEHRADUN-248 001 UTTARAKHAND</span><br>
                                  <span id="lbladd3" style="font-family:Verdana;font-size:8pt;"> </span>
                                </td>
                                <td align="right" class="Content"><span id="lblcontactperson" style="font-family:Verdana;font-size:8pt;">BHUPENDAR SINGH, UNDER SECRETARY</span>
                                  <br>
                                  <span id="lblclntname" style="font-family:Verdana;font-size:8pt;">Army DGR Recruitment</span><br>
                                  <span id="lblcladd1" style="font-family:Verdana;font-size:8pt;">UNION PUBLIC SERVICE COMMISSIO</span><br>
                                  <span id="lblcladd2" style="font-family:Verdana;font-size:8pt;">DHOLPUR HOUSE, SHAHJAHAN ROAD NEW DELHI - 110069</span><br>
                                  <span id="lblcladd3" style="font-family:Verdana;font-size:8pt;"></span><br>
                                  <span id="lblcladd4" style="font-family:Verdana;font-size:8pt;"></span></td>
                                </tr>
                              </tbody></table>
                            </td>
                          </tr>
                          <tr> 
                            <td colspan="2" align="center" valign="top">
                              <table width="100%" border="1" cellspacing="0" cellpadding="2">
                                <tbody><tr>
                                  <td class="Heading" align="center" style="HEIGHT: 25px">
                                    <b>विज्ञापन संख्या<br>
                                    Advt. No</b></td>
                                    <td class="Heading" align="center" style="HEIGHT: 25px">
                                      <b>वर्ग सेंटीमीटर में जगह<br>
                                      Space in Sq.cms</b></td>
                                      <td class="Heading" align="center" style="HEIGHT: 25px">
                                        <b>विज्ञापन का प्रकार<br>
                                        Type of Advt.</b></td>
                                      </tr>
                                      <tr align="center">
                                        <td><span id="lbldspkey" style="font-family:Verdana;font-size:8pt;">10621/14/0015/1617</span></td>
                                        <td><span id="lbllen" style="font-family:Verdana;font-size:8pt;">Len = 8</span>&nbsp;&nbsp;&nbsp;<span id="lblwid" style="font-family:Verdana;font-size:8pt;">Wid = 8</span>&nbsp;
                                          <span id="Label6" style="font-family:Verdana;font-size:8pt;">Size </span>=<span id="lblsize" style="font-family:Verdana;font-size:8pt;">64</span></td>
                                          <td><span id="lbltype" style="font-family:Verdana;font-size:8pt;">UPSC</span></td>
                                        </tr>
                                        <tr>
                                          <td align="center" class="Heading">
                                            <b>प्रकाशन की तिथि<br>
                                            Date of Publication</b></td>
                                            <td align="center" class="Heading">
                                              <b>इसके बाद नहीं<br>
                                              Not Later than</b></td>
                                              <td align="center" class="Heading">
                                                <b>आरओ अनुदेश<br>
                                                RO Instruction(s)</b></td>
                                              </tr>
                                              <tr align="center">
                                                <td><span id="lbldate" style="font-family:Verdana;font-size:8pt;">17/11/2016</span></td>
                                                <td><span id="lblnotlater" style="font-family:Verdana;font-size:8pt;">17/11/2016</span></td>
                                                <td><span id="lblins" style="font-family:Verdana;font-size:8pt;">B2 -  Black and white </span></td>
                                              </tr>
                                            </tbody></table>
                                          </td>
                                        </tr>
                                        <tr>
                                          <td colspan="2" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="2">
                                            <tbody><tr>
                                              <td colspan="4" class="Content" valign="top">
                                                कृपया सुनिश्चित कर लें कि जिस पृष्ठ में यह विज्ञापन है उसके फोलियो में दिनांक, 
                                                शीर्षक तथा प्रकाशन के स्थान का भी उल्लेख है। बिल प्रस्तुत करने की तिथि के बाद 
                                                प्रस्तुत किए गए बिलों पर विचार नहीं किया जाएगा।
                                                <br>
                                                <strong>नोट : विज्ञापन प्रकाशित नहीं किए जाने की स्थिति में, कारण बताते हुए आर.ओ. 
                                                  तुरंत लौटा दिया जाए। वि.दृ.प्र.नि. के सभी विज्ञापन मुख्य संस्करण में ही 
                                                  प्रकाशित किए जाएं। परिशिष्ट में प्रकाशित विज्ञापनों के लिए भुगतान नहीं किया 
                                                  जाएगा।<br>
                                                </strong>Please ensure that folio of the page carrying this advt. also carries 
                                                date, title and place of publication. Bills submitted after last date for 
                                                submission of bills will not be entertained.<br>
                                                <b style="Z-INDEX: 0">Note: In case the advt. is not published, R.O. may be 
                                                  returned immediately with reasons.<br>
                                                  All DAVP advertisements should be published only in the main edition. No 
                                                  payment will be made for advertisements published in supplements.<br>
                                                </b>
                                              </td>
                                            </tr> 
                                            <tr>
                                              <td colspan="4" align="right" class="Content">
                                                सहायक मीडिया कार्यकारी<br>
                                                कृते महानिदेशक, विदृप्रनि<br>
                                                Asst. Media Executive
                                                <br>
                                              for Director General,DAVP.</td>
                                            </tr>

                                            <tr><td colspan="4">This is a computer generated print out and no signature is required.</td></tr>
                                            <tr>
                                              <td colspan="4" align="center" class="Content">------------------------------------------------------ 
                                                यहाँ से काटें (Cut Here) ---------------------------------------------
                                                <br>
                                              </td>
                                            </tr>
                                            <tr>
                                              <td class="Heading">
                                                <b>विज्ञापन का विवरण:<br>
                                                Details of Advertisement:</b></td>
                                                <td>&nbsp;</td>
                                                <td class="Heading">
                                                  <b>* प्रकाशक द्वारा भरे जाने के लिए<br>
                                                  * To be filled in by publisher:</b></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                  <td class="Content">
                                                    समाचार पत्र कोड<br>
                                                  Newspaper Code</td>
                                                  <td class="Content"><span id="lblnp_code" style="font-family:Verdana;font-size:8pt;">100075</span></td>
                                                  <td class="Content">
                                                    बिल सँख्या<br>
                                                  Bill Number:</td>
                                                  <td class="Content">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                  <td class="Content">
                                                    समाचार-पत्र का नाम<br>
                                                  Name of the Newspaper:</td>
                                                  <td class="Content"><span id="lblname" style="font-family:Verdana;font-size:8pt;">THE HIMACHAL TIMES</span></td>
                                                  <td class="Content">
                                                    बिल की तारीख<br>
                                                  Bill Date:</td>
                                                  <td class="Content">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                  <td class="Content">
                                                    प्रकाशन स्थान<br>
                                                  Place of Publication</td>
                                                  <td class="Content"><span id="lblpub" style="font-family:Verdana;font-size:8pt;">DEHRADUN</span></td>
                                                  <td class="Content">
                                                    प्रकाशन की तिथि<br>
                                                  Date of Publication:</td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                  <td class="Content">
                                                    मुद्रण स्थान<br>
                                                  Place of printing:</td>
                                                  <td>&nbsp;</td>
                                                  <td class="Content">
                                                    श्याम श्वेत/रंगीन में प्रकाशित<br>
                                                  Published in b&amp;w/ Colour</td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                  <td class="Content">
                                                    आरओ संख्या<br>
                                                  RO NO :</td>
                                                  <td class="Content"><span id="lblro" style="font-family:Verdana;font-size:8pt;">10621/14/0015/1617</span></td>
                                                  <td class="Content">
                                                    (लंबाई सें. मी.)Length in Cms:<br>
                                                  (चौड़ाई सें. मी.)Width in Cms:</td>
                                                  <td>&nbsp;</td>
                                                </tr>

                                                <tr>
                                                  <td class="Content">
                                                    डीएवीपी की. नं0<br>
                                                  DAVP Key No</td>
                                                  <td class="Content"><span id="lblkey" style="font-family:Verdana;font-size:8pt;">10621/14/0015/1617</span></td>
                                                  <td class="Content">
                                                    उपयोग किये गए खाने<br>
                                                  No of Columns used:</td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                  <td class="Content">
                                                    आरओ के अनुसार विज्ञापन छापने की तारीख<br>
                                                  Insertion Date as per RO</td>
                                                  <td class="Content"><span id="lblinsdate" style="font-family:Verdana;font-size:8pt;">17/11/2016</span></td>
                                                  <td class="Content">
                                                    **वर्ग सेमी में उपयोग किया गया स्थान<br>
                                                  **Space used in Sq Cms:</td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                  <td class="Content">
                                                    आरओ मे लिखित दिनांक के बाद नहीं<br>
                                                  Not later then as per RO</td>
                                                  <td class="Content"><span id="lbllaterdate" style="font-family:Verdana;font-size:8pt;">17/11/2016</span></td>
                                                  <td class="Content">
                                                    बिल की कुल राशि<br>
                                                  Gross Amount of Bill</td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                  <td class="Content">
                                                    विज्ञापन का प्रकार<br>
                                                  Type of Advertisement</td>
                                                  <td class="Content"><span id="lbltype1" style="font-family:Verdana;font-size:8pt;">UPSC</span></td>
                                                  <td class="Content">
                                                    छूट<br>
                                                  Discount:</td>
                                                  <td>&nbsp;</td>
                                                </tr>

                                                <tr>
                                                  <td colspan="2" class="Content">
                                                    <span id="lblsize1" style="font-family:Verdana;font-size:8pt;width:264px;">Length in Cms (लंबाई सें. मी.): 8 Width in Cms (चौड़ाई सें. मी.):8</span></td>
                                                    <td class="Heading">
                                                      <b>बिल की शुद्ध राशि:<br>
                                                      Net Amount Of Bill:</b></td>
                                                      <td><img src="{{asset('img/amtbox.jpg')}}"></td>
                                                    </tr>

                                                    <tr>
                                                      <td class="Content">
                                                        श्याम श्वेत/रंगीन में प्रकाशित<br>
                                                      To Be published in:</td>
                                                      <td class="Content"><span id="lbltobe" style="font-family:Verdana;font-size:8pt;"> Black and white </span></td>
                                                      <td class="Content">
                                                        प्राप्त धनराशि (प्रतिपूरक बिल के मामले में)<br>
                                                      Amount received (In case of supp. Bill)</td>
                                                      <td><img src="{{asset('img/amtbox.jpg')}}"></td>
                                                    </tr>

                                                    <tr>
                                                      <td class="Content">
                                                        दर प्रति वर्ग. सेमी.<br>
                                                      Rate per Sq. Cms.:</td>
                                                      <td class="Content"><span id="lblrate" style="font-family:Verdana;font-size:8pt;">28.4400&nbsp;&nbsp;<b> (आरओ अपलोड के समय दर) Rate at the Time of RO Upload</b></span></td>
                                                      <td class="Heading">
                                                        <b>प्रतिपूरक बिल की शुद्ध राशि<br>
                                                        Net Amount of Supp. Bill:</b></td>
                                                        <td><img src="{{asset('img/amtbox.jpg')}}"></td>
                                                      </tr>
                                                      <tr>
                                                        <td class="Content">
                                                          बिल डीएवीपी को दि0: .<br>
                                                          अथवा उससे पहले प्रस्तुत कर दिया जाए<br>
                                                          Bills to be submitted to<br>
                                                        DAVP: on or before</td>
                                                        <td class="Content"><span id="lbldate1" style="font-family:Verdana;font-size:8pt;">16/01/2017</span></td>
                                                        <td>&nbsp;</td>
                                                        <td>&nbsp;</td>
                                                      </tr>

                                                      <tr>
                                                        <td colspan="2" class="Content">
                                                          प्रमाणित किया जाता है कि
                                                          <br>
                                                          ग्राहक को वाउचर प्रति उपरोक्त पते पर
                                                          <br>
                                                          भेज दी गयी है
                                                          <br>
                                                          Certified that voucher copy has been sent to
                                                          <br>
                                                        the client at the above address</td>
                                                        <td class="Content">
                                                          सहायक मीडिया कार्यकारी<br>
                                                        Asst. Media Executive</td>
                                                        <td>&nbsp;</td>
                                                      </tr>

                                                      <tr>
                                                        <td colspan="2" class="Content">
                                                          मुहर के साथ रसीदी टिकट पर प्रकाशक के हस्ताक्षर<br>
                                                          Signature of the Publisher on Revenue
                                                          <br>
                                                        Stamp with seal</td>
                                                        <td></td>
                                                        <td>&nbsp;</td>
                                                      </tr>
                                                    </tbody></table>
                                                  </td>
                                                </tr>

                                                <tr>
                                                  <td colspan="2" class="content">FOR SAFE INVESTMENT AND ATTRACTIVE RETURNS, INVEST IN NATIONAL SAVINGS SCHEME</td>
                                                </tr>


                                              </tbody>
                                            </table>
                                          </div>


                                        </div>

                                      </div>
                                    </div>

                                  </div>

                                  @endsection
