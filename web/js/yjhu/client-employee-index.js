$(document).ready( function () {
    'use strict';
    
    $('#organization_tree').jstree({
        "core" : {
            "themes" : {
                "responsive": false
            }            
        },
        "types" : {
            "default" : {
                "icon" : "fa fa-folder icon-state-warning icon-lg"
            },
            "file" : {
                "icon" : "fa fa-file icon-state-warning icon-lg"
            }
        },
        "plugins": ["types"]
    });
    
    $('#organization_tree').on("changed.jstree", function (e, data) {
        //        alert(data.node.li_attr.organization_id); 
        target_organization = data.node.li_attr.organization_id;
        redirectTo();
    });
    
    $('#search').click( function () {
//        alert($('#search-key').val());
        redirectToSearch($('#search-key').val());
    });
    
    $('#search-key').keydown( function (e) {
        if (e.keyCode == 13) {
//            alert($('#search-key').val());
            redirectToSearch($('#search-key').val());
        }
    });
});
