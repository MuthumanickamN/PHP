<?php $this->load->view('includes/header3'); ?>
<link href="https://cdn.webdatarocks.com/latest/webdatarocks.min.css" rel="stylesheet" />
<script src="https://cdn.webdatarocks.com/latest/webdatarocks.toolbar.min.js"></script>
<script src="https://cdn.webdatarocks.com/latest/webdatarocks.js"></script>
<script src="http://code.highcharts.com/4.2.2/highcharts.js"></script>
<script src="http://code.highcharts.com/4.2.2/highcharts-more.js"></script>
<script src="https://cdn.webdatarocks.com/latest/webdatarocks.highcharts.js"></script>
<style type="text/css">
    .wdr-credits{
        display: none;
    }
    #wdr-toolbar-wrapper #wdr-toolbar > li > a span, #wdr-toolbar-wrapper #wdr-toolbar > .wdr-toolbar-group-right > li > a span{
        top:60px;
    }   
</style>


  
   <div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <!--<div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title" style="color: green"><?php echo $title;?></h3>
                <div class="row breadcrumbs-top">
                  <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="<?php echo site_url(); ?>">Home</a></li>
                      <li class="breadcrumb-item"><a href="#"><?php echo $title;?> </a></li>
                    </ol>
                  </div>
                </div>
            </div>
        </div>-->
        <div class="col-lg-12"><span id="success-msg"></span></div>
        <div class="content-body">
            <!-- Zero configuration table -->
            <section id="configuration">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"><?php echo $title;?></h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>

                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard">
                                    <div class="mainbox col-sm-12">
                                        <div class="panel panel-info">
                                            
                                            <div class="row" style="margin-bottom: 20px">
                                                <div class="col-lg-2">
                                                   <b>From date</b>
                                                    <input type="date" id="from_date" name="from_date" class="form-control" value="<?php echo $fromDateVal;?>" placeholder="From date">
                                                </div>
                                                <div class="col-lg-3">
                                                    <b>To date</b>
                                                    <input type="date" id="to_date" name="to_date" class="form-control" value="<?php echo $toDateVal;?>" placeholder="To date">
                                                </div>
                                                
                                                <div class="col-lg-1">
                                                <input type="radio" id="Quarterly" name="option" value="Quarterly">
                                                <label for="Quarterly">Quarterly</label>
                                                </div>
                                                <div class="col-lg-1">
                                                <input type="radio" id="Monthly" name="option" value="Monthly" checked>
                                                <label for="Monthly">Monthly</label>
                                                </div>
                                                <div class="col-lg-1">
                                                <input type="radio" id="Yearly" name="option" value="Yearly">
                                                <label for="Yearly">Yearly</label>
                                                </div>                                           
                                                <div class="col-lg-2">
                                                <button id="fetch" class="btn btn-success margin-top-20 fetch">Search</button>


                                                
                                             </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                      
                                            
    <!-- Main content -->
    <section class="content">
        <div class="clearfix"></div>
        <div id="wdr-component"></div>
        <div class="clearfix"></div>
    </section>
          
    


          
<script type="text/javascript">

jQuery(document).ready(function()
{ 
    var fromdateval = jQuery('#from_date').val();
    var todateval = jQuery('#to_date').val();
    //var value=jQuery('#data').val();
    var Value = $("input[name='option']:checked").val();

    get_coach_report(fromdateval, todateval,Value );

    $('.fetch').on('click', function(){
        
        var fromdateval = jQuery('#from_date').val();
        var todateval = jQuery('#to_date').val();
        var Value = $("input[name='option']:checked").val();
      /*  output = $('input[name=data]:checked','#Quarterly').val();
        document.querySelector('.output').textContent = output;
        output = $('input[name=data]:checked','#Monthly').val();
        document.querySelector('.output').textContent = output;
        output = $('input[name=data]:checked','#Yearly').val();
        document.querySelector('.output').textContent = output;*/
        if(fromdateval == ''){
            alert('select from date');
            return false;
        }
        if(todateval == ''){
            alert('select to date');
            return false;
        }
        // console.log(Value,$("input[name='option']:checked"));
        // alert(Value);

        if(fromdateval !='' && todateval != '' )
        {
            get_coach_report(fromdateval, todateval ,Value);
        }
        
    });
  
});


function get_coach_report(fromdateval='', todateval='' ,revenue){


  $.ajax({
                  type: "POST",
                  url: base_url+"Accountsreport/coach_activity_wise_revenue_list",
                  data:{'from_date':fromdateval, 'to_date':todateval,'revenue':revenue},
                  async: false,
                  datatype: "json",
                  success : function(data)
                    {

                      var obj=JSON.parse(data);
                      //console.log(obj);
                        var output =[];
                      var output1 =[ {"Coach": {
                            "type": "string"
                        },"Location": {
                            "type": "string"
                        },"Activity": {
                            "type": "string"
                        },"Revenue": {
                            "type": "number"
                        },"Date": {
                            //"type": "date/month/year"
                            "type": "year-month"
                            
                        }} ];    
                        
                               
                      
                      var pivot = new WebDataRocks({
                          container: "#wdr-component",
                          toolbar: true,
                          report: {
                              "dataSource": {
                                  "dataSourceType": "json",
                                  "data": getJSONData()
                              },
                              "options": {
                                  "grid": {
                                      "type": "classic"
                                  }
                              },
                               slice: {
                                    rows: [
                                        {
                                            uniqueName: "Coach"
                                        }, {
                                            uniqueName: "Location"
                                        },{
                                            uniqueName: "Activity"
                                        },
                                        {
                                            uniqueName: "Measures"
                                        }
                                    ],
                                    columns: [
                                        {
                                            uniqueName: "Date",
                                            "sort": "desc"
                                        }
                                    ],
                                    measures: [
                                        {
                                            uniqueName: "Revenue"
                                        }
                                    ],
                                "expandAll":true 								
                          },
                           "formats": [
                              {
                                  "name": "",
                                  "decimalPlaces": 0,
                                  "currencySymbol": "$",
                                  "thousandsSeparator":","
                              }
                          ]
                          }

                      });
                      
                      

                      function getJSONData() {
						$.each(obj, function(key, value){

                          // (value.Kpcs).toLocaleString();	
                         // console.log('value '+ value);
							output.push(key);
							output1.push(value);
                        		
                        });		
						//console.log(output1);
                        output1.toLocaleString();
						console.log(output1);						
						return output1 ;                           
					   }

                      
                      
                    },
                  fail: function( jqXHR, textStatus, errorThrown ) {
                  console.log( 'Could not get posts, server response: ' + textStatus + ': ' + errorThrown );
                  }
              });
  

}

</script>