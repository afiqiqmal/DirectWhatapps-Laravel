demo = {
        showNotification: function(from, align,message){
            type = ['','info','success','warning','danger','rose','primary'];
            $.notify({
                icon: "notifications",
                message: message

            },{
                type: type[5],
                timer: 1000,
                placement: {
                    from: from,
                    align: align
                }
            });
        }
    }