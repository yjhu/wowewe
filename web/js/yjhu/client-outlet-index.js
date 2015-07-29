$(document).ready( function () {
    'use strict';
    
    $('#msc_tree').jstree({
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
    
    $('#msc_tree').on("changed.jstree", function (e, data) {
//        alert(data.node.li_attr.organization_id); 
        target_msc = data.node.li_attr.organization_id;
        redirectTo();
    });
});
