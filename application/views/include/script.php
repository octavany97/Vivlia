<!-- //notification -->
<script>
    // funtion javascript untuk nampilin jumlah notif yang belum dibaca pada tipe pengguna admin penerbit
    function load_unseen_notification_admin(){
        $.ajax({
            url:"<?php echo base_url();?>adm/getCountNotif",
            method:"POST",
            success:function(data){
                if(data > 0) $('.count').html(data)
            },
            error: function(xhr, status){
                alert("Oops there is an error!")
            }
        })
    }
    // funtion javascript untuk nampilin jumlah notif yang belum dibaca pada tipe pengguna di toko
    function load_unseen_notification_toko(){
        $.ajax({
            url:"<?php echo base_url();?>csh/getCountNotif",
            method:"POST",
            success:function(data){
                console.log(data)
                if(data > 0) $('.count').html(data)
            },
            error: function(xhr, status){
                alert("Oops there is an error!")
            }
        })
    }
    // function javascript untuk ubah nilai kolom flag untuk tipe pengguna admin penerbit
    function changeFlagAdmin(flag,id){
        // mengubah tampilan list notif (jika flag berubah tampilan warna di list notif juga berubah)
        $.ajax({
            method: "POST",
            url: "<?php echo base_url() ?>adm/changeNotifFlag/",
            data: 'flag='+flag+'&id_notif='+id,
            success: function(classes){
                $('#listNotif').empty().html(classes)       
            },
            error: function(xhr, status){
                alert("Oops there is an error!")
            }
        })
        // ini ganti button kalo berubah flag nya pada detail notif
        $.ajax({
            method: "POST",
            url: "<?php echo base_url() ?>adm/changeNotifDetail/",
            data: 'id_notif='+id,
            success: function(classes){
                $('#detailNotif').empty().html(classes)     
            },
            error: function(xhr, status){
                alert("Oops there is an error!")
            }
        })
    }
    // function javascript untuk ganti flag notif di manager/kasir
    function changeFlagManager(flag,id){
        $.ajax({
            method: "POST",
            url: "<?php echo base_url() ?>mgr/changeNotifFlag/",
            data: 'flag='+flag+'&id_notif='+id,
            success: function(classes){
                $('#listNotif').empty().html(classes)       
            },
            error: function(xhr, status){
                alert("Oops there is an error!")
            }
        })
    }
    // function javascript nampilin detail notif ketika ganti dari list notif pada tipe pengguna admin
    function showDetailAdmin(id){
        $.ajax({
            method: "POST",
            url: "<?php echo base_url() ?>adm/changeNotifDetail/",
            data: 'id_notif='+id,
            success: function(classes){
                $('#detailNotif').empty().html(classes)             
            },
            error: function(xhr, status){
                alert("Oops there is an error!")
            }
        })
    }
    // function javascript nampilin detail notif ketika ganti dari list notif pada tipe pengguna manager/kasir
    function showDetailManager(id){
        $.ajax({
            method: "POST",
            url: "<?php echo base_url() ?>mgr/changeNotifDetail/",
            data: 'id_notif='+id,
            success: function(classes){
                $('#detailNotif').empty().html(classes)             
            },
            error: function(xhr, status){
                alert("Oops there is an error!")
            }
        })
    }
</script>
