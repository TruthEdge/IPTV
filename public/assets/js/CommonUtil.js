IPTV.ns('IPTV.CommonUtil');
IPTV.CommonUtil = {
    publicPath:window.location.origin+"/",
SetDefaultImageOnError:function(){
    $(document).ready(function() {
        $('img').on('error', function() {
          $(this).attr('src', this.publicPath+"/images/default.png");
          $(this).onerror = null;
        });
      });
}
}
