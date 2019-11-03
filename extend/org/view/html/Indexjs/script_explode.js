  var url="{:url('export')}";
  var search_data=$("#search_form").serializeArray();
  var urlparam="";
  for(var j = 0,len = search_data.length; j < len; j++){
    urlparam+="search_data["+j+"][name]="+search_data[j]['name']+"&";
    urlparam+="search_data["+j+"][value]="+search_data[j]['value']+"&";
  }
  url=url+"?"+urlparam;
  layui.use(['jquery', 'excel', 'layer'], function() {
    var $ = layui.jquery;
    var layer = layui.layer;
    var excel = layui.excel;
    // 模拟从后端接口读取需要导出的数据
    $.ajax({
      url: url
      ,dataType: 'json'
      ,success: function(res) {
        if(res.code==0){
          var data = res.data;
        // 重点！！！如果后端给的数据顺序和映射关系不对，请执行梳理函数后导出
        data = excel.filterExportData(data, {
          id: 'id'
          ,user_name: 'user_name'
          ,usercard: 'usercard'
          ,mobile: 'mobile'
          ,status: 'status'
          ,error_type: 'error_type'
          ,need_send: function(value, line, data) {
            return {
              v: value==1?"邮寄":"自取",
            };
          }
          ,note: 'note'
          ,create_time: ' create_time'
          ,update_time: 'update_time'
        });
        // 重点2！！！一般都需要加一个表头，表头的键名顺序需要与最终导出的数据一致
        data.unshift({ id: "ID", user_name: "{$lang.field.user_name}", usercard: '{$lang.field.usercard}', mobile: '{$lang.field.mobile}', status: '{$lang.field.status}', error_type: '{$lang.field.error_type}', need_send: '{$lang.field.need_send}',note: '{$lang.field.note}', create_time: '{$time.create}', update_time: '{$time.update}' });
      //  var timestart = Date.now();
      excel.exportExcel({
        sheet1: data
      }, $('legend').html()+'.xlsx', 'xlsx');
        //var timeend = Date.now();

        //var spent = (timeend - timestart) / 1000;
       // layer.alert('单纯导出耗时 '+spent+' s');

     }else{
      layer.alert("{lang.explode_err}");

    }

  }
  ,error: function() {
    layer.alert('获取数据失败，请检查是否部署在本地服务器环境下');
  }
});
  });
}
