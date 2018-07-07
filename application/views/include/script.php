<!-- //notification -->
<script>
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
    function load_unseen_notification_toko(){
        $.ajax({
            url:"<?php echo base_url();?>csh/getCountNotif",
            method:"POST",
            success:function(data){
                if(data > 0) $('.count').html(data)
                console.log(data)
            },
            error: function(xhr, status){
                alert("Oops there is an error!")
            }
        })
    }
    function changeFlagAdmin(flag,id){
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

    function changeFlagAdmin(flag,id){
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
</script>
