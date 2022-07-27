<?php
namespace App\Http\Traits;
use Illuminate\Http\Request;
use DB;
use Session;
trait clientRequestTableTrait
{
   /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    
protected $tblClientRequestHeader='BOC$Client Request Header$3f88596c-e20d-438c-a694-309eb14559b2';
protected $tblPrintClientRequest='BOC$Print Client Request$3f88596c-e20d-438c-a694-309eb14559b2';
protected $tblODMediaRequestHeader='BOC$OD Media Request Header$3f88596c-e20d-438c-a694-309eb14559b2';
protected $tblAVMedia='BOC$AV Media$3f88596c-e20d-438c-a694-309eb14559b2';
protected $tblPrintMediaPlan='BOC$Print Media Plan$3f88596c-e20d-438c-a694-309eb14559b2';
protected $tblAVMediaPlan='BOC$New AV Media Plan$3f88596c-e20d-438c-a694-309eb14559b2';
protected $tblFMRadioMediaPlanHeader='BOC$FM Radio Media Plan Header$3f88596c-e20d-438c-a694-309eb14559b2';
protected $tblODMediaPlanHeader='BOC$OD Media Plan Header$3f88596c-e20d-438c-a694-309eb14559b2';
protected $tblNewspaperSelect= 'BOC$Newspaper Select$3f88596c-e20d-438c-a694-309eb14559b2';
protected $tblMinistriesHead='BOC$Ministries Head$3f88596c-e20d-438c-a694-309eb14559b2';
protected $tblODMediaRequest='BOC$OD Media Request$3f88596c-e20d-438c-a694-309eb14559b2';
protected $tblRadioMediaRequest='BOC$Radio Media Request$3f88596c-e20d-438c-a694-309eb14559b2';
protected $tblCitySelection='BOC$City Selection$3f88596c-e20d-438c-a694-309eb14559b2';
protected $tblStateSelection='BOC$State Selection$3f88596c-e20d-438c-a694-309eb14559b2';
protected $tblLanguageSelection='BOC$Language Selection$3f88596c-e20d-438c-a694-309eb14559b2';
protected $tblAVLanguageSelection='BOC$AV Language Selection$3f88596c-e20d-438c-a694-309eb14559b2';
protected $tblMinistries='BOC$Ministries$3f88596c-e20d-438c-a694-309eb14559b2';
protected $tblState='BOC$State$d3c551dd-5903-4194-b153-04ced9d29a2c';
protected $tblIndianCity='BOC$Indian City$3f88596c-e20d-438c-a694-309eb14559b2';
protected $tblVendorEmpPrint='BOC$Vendor Emp - Print$3f88596c-e20d-438c-a694-309eb14559b2';
protected $tblROHeader= 'BOC$RO Header$3f88596c-e20d-438c-a694-309eb14559b2';
protected $tblODROHeader= 'BOC$OD RO Header$3f88596c-e20d-438c-a694-309eb14559b2';
protected $tblAVROHeader= 'BOC$AV RO Header$3f88596c-e20d-438c-a694-309eb14559b2';
protected $tblAVROLine= 'BOC$AV RO Line$3f88596c-e20d-438c-a694-309eb14559b2';
protected $tblODROLine= 'BOC$OD RO Line$3f88596c-e20d-438c-a694-309eb14559b2';
protected $tblROLine= 'BOC$RO Line$3f88596c-e20d-438c-a694-309eb14559b2';
protected $tblLanguage='BOC$Language$63ca2fa4-4f03-4f2b-a480-172fef340d3f';
protected $tblChannelSelect='BOC$New Channel Select$3f88596c-e20d-438c-a694-309eb14559b2';
protected $tblAVVendor='BOC$AV Vendor$3f88596c-e20d-438c-a694-309eb14559b2';
protected $tblODMediaPlanLine='BOC$OD Media Plan Line$3f88596c-e20d-438c-a694-309eb14559b2';
protected $tblFMRadioMedaPlanLine='BOC$FM Radio Media Plan Line$3f88596c-e20d-438c-a694-309eb14559b2';

   
}

?>