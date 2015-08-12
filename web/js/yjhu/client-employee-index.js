$(document).ready( function () {
    'use strict';
    
    $('#organization_tree').jstree({
        "core" : {
            "themes" : {
                "responsive": false
            },
            "check_callback" : true
        },
        "types" : {
            "default" : {
                "icon" : "fa fa-sitemap icon-state-warning icon-lg"
            },
            "file" : {
                "icon" : "fa fa-file icon-state-warning icon-lg"
            }
        },
        "plugins": [ "contextmenu", "dnd", "types"],
        'contextmenu': {
            'select_node': false,
            'items' : { 
                "create" : {
                    "label"             : "新建",
                    "action"            : function (data) {
                        var inst = $.jstree.reference(data.reference),
                                obj = inst.get_node(data.reference);
                        var args = {
                            'classname':    '\\app\\models\\ClientOrganization',
                            'funcname':     'createAjax',
                            'params':       {
                                'client_id': 1,
                                'superior_id': obj.li_attr.organization_id,
                                'organization_title': '新建部门'
                            } 
                        };
                        $.ajax({
                            url:        ajax_url,
                            type:       "GET",
                            cache:      false,
                            dataType:   "json",
                            data:       "args=" + JSON.stringify(args),
                            success:    function(ret) { 
                                if (0 === ret['ret_code']) {
                                    inst.create_node(obj, {'text': '新建部门'}, "last", function (new_node) {
//                                        new_node.text = '新建部门';
                                        new_node.li_attr = {'organization_id': ret['organization_id']};
                                        inst.refresh_node(new_node);
                                        //setTimeout(function () { inst.edit(new_node); },0);
                                    });
                                }
                            },                        
                            error:      function(){
                                alert('发送失败。');
                            }
                        });                       
                    }
                },
                "rename" : {
                    "label"             : "更名",
                    "action"            : function (data) {
                        var inst = $.jstree.reference(data.reference),
                                obj = inst.get_node(data.reference);
                        inst.edit(obj);
                    }
                },
                "remove" : {
                    "label"             : "删除",
                    "action"            : function (data) {
                        var inst = $.jstree.reference(data.reference),
                                obj = inst.get_node(data.reference);
                        if (obj.parent == '#') {
                            alert('根部门，不能删除！');
                            return;
                        }
                        var args = {
                            'classname':    '\\app\\models\\ClientOrganization',
                            'funcname':     'deleteAjax',
                            'params':       {
                                'organization_id': obj.li_attr.organization_id
                            } 
                        };
                        $.ajax({
                            url:        ajax_url,
                            type:       "GET",
                            cache:      false,
                            dataType:   "json",
                            data:       "args=" + JSON.stringify(args),
                            success:    function(ret) { 
                                if (0 === ret['ret_code']) {
                                    if(inst.is_selected(obj)) {
                                        inst.delete_node(inst.get_selected());
                                    }
                                    else {
                                        inst.delete_node(obj);
                                    }
                                } else {
                                    alert('该部门有下属部门，或员工，或门店，不能删除！');
                                }
                            },                        
                            error:      function(){
                                alert('发送失败。');
                            }
                        });                                              
                    }
                }                
            }
        }
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
