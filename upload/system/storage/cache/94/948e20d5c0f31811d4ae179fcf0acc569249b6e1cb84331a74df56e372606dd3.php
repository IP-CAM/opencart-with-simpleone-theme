<?php

/* design/layout_form.twig */
class __TwigTemplate_65a265bd8a75ad1baf4ce891b1cb70d5ed9afe43200a04baa9a67507b3fed1ed extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo (isset($context["header"]) ? $context["header"] : null);
        echo (isset($context["column_left"]) ? $context["column_left"] : null);
        echo "
<div id=\"content\">
  <div class=\"page-header\">
    <div class=\"container-fluid\">
      <div class=\"pull-right\">
        <button type=\"submit\" form=\"form-layout\" data-toggle=\"tooltip\" title=\"";
        // line 6
        echo (isset($context["button_save"]) ? $context["button_save"] : null);
        echo "\" class=\"btn btn-primary\"><i class=\"fa fa-save\"></i></button>
        <a href=\"";
        // line 7
        echo (isset($context["cancel"]) ? $context["cancel"] : null);
        echo "\" data-toggle=\"tooltip\" title=\"";
        echo (isset($context["button_cancel"]) ? $context["button_cancel"] : null);
        echo "\" class=\"btn btn-default\"><i class=\"fa fa-reply\"></i></a></div>
      <h1>";
        // line 8
        echo (isset($context["heading_title"]) ? $context["heading_title"] : null);
        echo "</h1>
      <ul class=\"breadcrumb\">";
        // line 10
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["breadcrumbs"]) ? $context["breadcrumbs"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["breadcrumb"]) {
            // line 11
            echo "        <li><a href=\"";
            echo $this->getAttribute($context["breadcrumb"], "href", array());
            echo "\">";
            echo $this->getAttribute($context["breadcrumb"], "text", array());
            echo "</a></li>";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['breadcrumb'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 13
        echo "      </ul>
    </div>
  </div>
  <div class=\"container-fluid\">";
        // line 17
        if ((isset($context["error_warning"]) ? $context["error_warning"] : null)) {
            // line 18
            echo "    <div class=\"alert alert-danger alert-dismissible\"><i class=\"fa fa-exclamation-circle\"></i>";
            echo (isset($context["error_warning"]) ? $context["error_warning"] : null);
            echo "
      <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
    </div>";
        }
        // line 22
        echo "    <div class=\"panel panel-default\">
      <div class=\"panel-heading\">
        <h3 class=\"panel-title\"><i class=\"fa fa-pencil\"></i>";
        // line 24
        echo (isset($context["text_form"]) ? $context["text_form"] : null);
        echo "</h3>
      </div>
      <div class=\"panel-body\">
        <form action=\"";
        // line 27
        echo (isset($context["action"]) ? $context["action"] : null);
        echo "\" method=\"post\" enctype=\"multipart/form-data\" id=\"form-layout\" class=\"form-horizontal\">
          <fieldset>
            <legend>";
        // line 29
        echo (isset($context["text_route"]) ? $context["text_route"] : null);
        echo "</legend>
            <div class=\"form-group required\">
              <label class=\"col-sm-2 control-label\" for=\"input-name\">";
        // line 31
        echo (isset($context["entry_name"]) ? $context["entry_name"] : null);
        echo "</label>
              <div class=\"col-sm-10\">
                <input type=\"text\" name=\"name\" value=\"";
        // line 33
        echo (isset($context["name"]) ? $context["name"] : null);
        echo "\" placeholder=\"";
        echo (isset($context["entry_name"]) ? $context["entry_name"] : null);
        echo "\" id=\"input-name\" class=\"form-control\" />";
        // line 34
        if ((isset($context["error_name"]) ? $context["error_name"] : null)) {
            // line 35
            echo "                <div class=\"text-danger\">";
            echo (isset($context["error_name"]) ? $context["error_name"] : null);
            echo "</div>";
        }
        // line 37
        echo "              </div>
            </div>
            <table id=\"route\" class=\"table table-striped table-bordered table-hover\">
              <thead>
                <tr>
                  <td class=\"text-left\">";
        // line 42
        echo (isset($context["entry_store"]) ? $context["entry_store"] : null);
        echo "</td>
                  <td class=\"text-left\">";
        // line 43
        echo (isset($context["entry_route"]) ? $context["entry_route"] : null);
        echo "</td>
                  <td></td>
                </tr>
              </thead>
              <tbody>";
        // line 48
        $context["route_row"] = 0;
        // line 49
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["layout_routes"]) ? $context["layout_routes"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["layout_route"]) {
            // line 50
            echo "                <tr id=\"route-row";
            echo (isset($context["route_row"]) ? $context["route_row"] : null);
            echo "\">
                  <td class=\"text-left\"><select name=\"layout_route[";
            // line 51
            echo (isset($context["route_row"]) ? $context["route_row"] : null);
            echo "][store_id]\" class=\"form-control\">
                      <option value=\"0\">";
            // line 52
            echo (isset($context["text_default"]) ? $context["text_default"] : null);
            echo "</option>";
            // line 53
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["stores"]) ? $context["stores"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["store"]) {
                // line 54
                if (($this->getAttribute($context["store"], "store_id", array()) == $this->getAttribute($context["layout_route"], "store_id", array()))) {
                    // line 55
                    echo "                      <option value=\"";
                    echo $this->getAttribute($context["store"], "store_id", array());
                    echo "\" selected=\"selected\">";
                    echo $this->getAttribute($context["store"], "name", array());
                    echo "</option>";
                } else {
                    // line 57
                    echo "                      <option value=\"";
                    echo $this->getAttribute($context["store"], "store_id", array());
                    echo "\">";
                    echo $this->getAttribute($context["store"], "name", array());
                    echo "</option>";
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['store'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 60
            echo "                    </select></td>
                  <td class=\"text-left\"><input type=\"text\" name=\"layout_route[";
            // line 61
            echo (isset($context["route_row"]) ? $context["route_row"] : null);
            echo "][route]\" value=\"";
            echo $this->getAttribute($context["layout_route"], "route", array());
            echo "\" placeholder=\"";
            echo (isset($context["entry_route"]) ? $context["entry_route"] : null);
            echo "\" class=\"form-control\" /></td>
                  <td class=\"text-left\"><button type=\"button\" onclick=\"\$('#route-row";
            // line 62
            echo (isset($context["route_row"]) ? $context["route_row"] : null);
            echo "').remove();\" data-toggle=\"tooltip\" title=\"";
            echo (isset($context["button_remove"]) ? $context["button_remove"] : null);
            echo "\" class=\"btn btn-danger\"><i class=\"fa fa-minus-circle\"></i></button></td>
                </tr>";
            // line 64
            $context["route_row"] = ((isset($context["route_row"]) ? $context["route_row"] : null) + 1);
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['layout_route'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 66
        echo "              </tbody>
              <tfoot>
                <tr>
                  <td colspan=\"2\"></td>
                  <td class=\"text-left\"><button type=\"button\" onclick=\"addRoute();\" data-toggle=\"tooltip\" title=\"";
        // line 70
        echo (isset($context["button_route_add"]) ? $context["button_route_add"] : null);
        echo "\" class=\"btn btn-primary\"><i class=\"fa fa-plus-circle\"></i></button></td>
                </tr>
              </tfoot>
            </table>
          </fieldset>
          <fieldset>
            <legend>";
        // line 76
        echo (isset($context["text_module"]) ? $context["text_module"] : null);
        echo "</legend>";
        // line 77
        $context["module_row"] = 0;
        // line 78
        echo "            <div class=\"row\">
              <div class=\"col-lg-3 col-md-4 col-sm-12\">
                <table id=\"module-column-left\" class=\"table table-striped table-bordered table-hover\">
                  <thead>
                    <tr>
                      <td class=\"text-center\">";
        // line 83
        echo (isset($context["text_column_left"]) ? $context["text_column_left"] : null);
        echo "</td>
                    </tr>
                  </thead>
                  <tbody>";
        // line 87
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["layout_modules"]) ? $context["layout_modules"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["layout_module"]) {
            // line 88
            if (($this->getAttribute($context["layout_module"], "position", array()) == "column_left")) {
                // line 89
                echo "                    <tr id=\"module-row";
                echo (isset($context["module_row"]) ? $context["module_row"] : null);
                echo "\">
                      <td class=\"text-left\"><div class=\"input-group\">
                          <select name=\"layout_module[";
                // line 91
                echo (isset($context["module_row"]) ? $context["module_row"] : null);
                echo "][code]\" class=\"form-control input-sm\">";
                // line 92
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable((isset($context["extensions"]) ? $context["extensions"] : null));
                foreach ($context['_seq'] as $context["_key"] => $context["extension"]) {
                    // line 93
                    echo "                            <optgroup label=\"";
                    echo $this->getAttribute($context["extension"], "name", array());
                    echo "\">";
                    // line 94
                    if ( !$this->getAttribute($context["extension"], "module", array())) {
                        // line 95
                        if (($this->getAttribute($context["extension"], "code", array()) == $this->getAttribute($context["layout_module"], "code", array()))) {
                            // line 96
                            echo "                            <option value=\"";
                            echo $this->getAttribute($context["extension"], "code", array());
                            echo "\" selected=\"selected\">";
                            echo $this->getAttribute($context["extension"], "name", array());
                            echo "</option>";
                        } else {
                            // line 98
                            echo "                            <option value=\"";
                            echo $this->getAttribute($context["extension"], "code", array());
                            echo "\">";
                            echo $this->getAttribute($context["extension"], "name", array());
                            echo "</option>";
                        }
                    } else {
                        // line 101
                        $context['_parent'] = $context;
                        $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["extension"], "module", array()));
                        foreach ($context['_seq'] as $context["_key"] => $context["module"]) {
                            // line 102
                            if (($this->getAttribute($context["module"], "code", array()) == $this->getAttribute($context["layout_module"], "code", array()))) {
                                // line 103
                                echo "                            <option value=\"";
                                echo $this->getAttribute($context["module"], "code", array());
                                echo "\" selected=\"selected\">";
                                echo $this->getAttribute($context["module"], "name", array());
                                echo "</option>";
                            } else {
                                // line 105
                                echo "                            <option value=\"";
                                echo $this->getAttribute($context["module"], "code", array());
                                echo "\">";
                                echo $this->getAttribute($context["module"], "name", array());
                                echo "</option>";
                            }
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['module'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                    }
                    // line 109
                    echo "                            </optgroup>";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['extension'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 111
                echo "                          </select>
                          <input type=\"hidden\" name=\"layout_module[";
                // line 112
                echo (isset($context["module_row"]) ? $context["module_row"] : null);
                echo "][position]\" value=\"";
                echo $this->getAttribute($context["layout_module"], "position", array());
                echo "\" />
                          <input type=\"hidden\" name=\"layout_module[";
                // line 113
                echo (isset($context["module_row"]) ? $context["module_row"] : null);
                echo "][sort_order]\" value=\"";
                echo $this->getAttribute($context["layout_module"], "sort_order", array());
                echo "\" />
                          <div class=\"input-group-btn\"><a href=\"";
                // line 114
                echo $this->getAttribute($context["layout_module"], "edit", array());
                echo "\" type=\"button\" data-toggle=\"tooltip\" title=\"";
                echo (isset($context["button_edit"]) ? $context["button_edit"] : null);
                echo "\" target=\"_blank\" class=\"btn btn-primary btn-sm\"><i class=\"fa fa-pencil\"></i></a>
                            <button type=\"button\" onclick=\"\$('#module-row";
                // line 115
                echo (isset($context["module_row"]) ? $context["module_row"] : null);
                echo "').remove();\" data-toggle=\"tooltip\" title=\"";
                echo (isset($context["button_remove"]) ? $context["button_remove"] : null);
                echo "\" class=\"btn btn-danger btn-sm\"><i class=\"fa fa fa-minus-circle\"></i></button>
                          </div>
                        </div></td>
                    </tr>";
                // line 119
                $context["module_row"] = ((isset($context["module_row"]) ? $context["module_row"] : null) + 1);
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['layout_module'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 122
        echo "                  </tbody>
                  <tfoot>
                    <tr>
                      <td class=\"text-left\"><div class=\"input-group\">
                          <select class=\"form-control input-sm\">
                            <option value=\"\"></option>";
        // line 128
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["extensions"]) ? $context["extensions"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["extension"]) {
            // line 129
            echo "                            <optgroup label=\"";
            echo $this->getAttribute($context["extension"], "name", array());
            echo "\">";
            // line 130
            if ( !$this->getAttribute($context["extension"], "module", array())) {
                // line 131
                echo "                            <option value=\"";
                echo $this->getAttribute($context["extension"], "code", array());
                echo "\">";
                echo $this->getAttribute($context["extension"], "name", array());
                echo "</option>";
            } else {
                // line 133
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["extension"], "module", array()));
                foreach ($context['_seq'] as $context["_key"] => $context["module"]) {
                    // line 134
                    echo "                            <option value=\"";
                    echo $this->getAttribute($context["module"], "code", array());
                    echo "\">";
                    echo $this->getAttribute($context["module"], "name", array());
                    echo "</option>";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['module'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
            }
            // line 137
            echo "                            </optgroup>";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['extension'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 139
        echo "                          </select>
                          <div class=\"input-group-btn\">
                            <button type=\"button\" onclick=\"addModule('column-left');\" data-toggle=\"tooltip\" title=\"";
        // line 141
        echo (isset($context["button_module_add"]) ? $context["button_module_add"] : null);
        echo "\" class=\"btn btn-primary btn-sm\"><i class=\"fa fa-plus-circle\"></i></button>
                          </div>
                        </div></td>
                    </tr>
                  </tfoot>
                </table>
              </div>
              <div class=\"col-lg-6 col-md-4 col-sm-12\">
                <table id=\"module-content-top\" class=\"table table-striped table-bordered table-hover\">
                  <thead>
                    <tr>
                      <td class=\"text-center\">";
        // line 152
        echo (isset($context["text_content_top"]) ? $context["text_content_top"] : null);
        echo "</td>
                    </tr>
                  </thead>
                  <tbody>";
        // line 156
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["layout_modules"]) ? $context["layout_modules"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["layout_module"]) {
            // line 157
            if (($this->getAttribute($context["layout_module"], "position", array()) == "content_top")) {
                // line 158
                echo "                    <tr id=\"module-row";
                echo (isset($context["module_row"]) ? $context["module_row"] : null);
                echo "\">
                      <td class=\"text-left\"><div class=\"input-group\">
                          <select name=\"layout_module[";
                // line 160
                echo (isset($context["module_row"]) ? $context["module_row"] : null);
                echo "][code]\" class=\"form-control input-sm\">";
                // line 161
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable((isset($context["extensions"]) ? $context["extensions"] : null));
                foreach ($context['_seq'] as $context["_key"] => $context["extension"]) {
                    // line 162
                    echo "                            <optgroup label=\"";
                    echo $this->getAttribute($context["extension"], "name", array());
                    echo "\">";
                    // line 163
                    if ( !$this->getAttribute($context["extension"], "module", array())) {
                        // line 164
                        if (($this->getAttribute($context["extension"], "code", array()) == $this->getAttribute($context["layout_module"], "code", array()))) {
                            // line 165
                            echo "                            <option value=\"";
                            echo $this->getAttribute($context["extension"], "code", array());
                            echo "\" selected=\"selected\">";
                            echo $this->getAttribute($context["extension"], "name", array());
                            echo "</option>";
                        } else {
                            // line 167
                            echo "                            <option value=\"";
                            echo $this->getAttribute($context["extension"], "code", array());
                            echo "\">";
                            echo $this->getAttribute($context["extension"], "name", array());
                            echo "</option>";
                        }
                    } else {
                        // line 170
                        $context['_parent'] = $context;
                        $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["extension"], "module", array()));
                        foreach ($context['_seq'] as $context["_key"] => $context["module"]) {
                            // line 171
                            if (($this->getAttribute($context["module"], "code", array()) == $this->getAttribute($context["layout_module"], "code", array()))) {
                                // line 172
                                echo "                            <option value=\"";
                                echo $this->getAttribute($context["module"], "code", array());
                                echo "\" selected=\"selected\">";
                                echo $this->getAttribute($context["module"], "name", array());
                                echo "</option>";
                            } else {
                                // line 174
                                echo "                            <option value=\"";
                                echo $this->getAttribute($context["module"], "code", array());
                                echo "\">";
                                echo $this->getAttribute($context["module"], "name", array());
                                echo "</option>";
                            }
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['module'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                    }
                    // line 178
                    echo "                            </optgroup>";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['extension'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 180
                echo "                          </select>
                          <input type=\"hidden\" name=\"layout_module[";
                // line 181
                echo (isset($context["module_row"]) ? $context["module_row"] : null);
                echo "][position]\" value=\"";
                echo $this->getAttribute($context["layout_module"], "position", array());
                echo "\" />
                          <input type=\"hidden\" name=\"layout_module[";
                // line 182
                echo (isset($context["module_row"]) ? $context["module_row"] : null);
                echo "][sort_order]\" value=\"";
                echo $this->getAttribute($context["layout_module"], "sort_order", array());
                echo "\" />
                          <div class=\"input-group-btn\"> <a href=\"";
                // line 183
                echo $this->getAttribute($context["layout_module"], "edit", array());
                echo "\" type=\"button\" data-toggle=\"tooltip\" title=\"";
                echo (isset($context["button_edit"]) ? $context["button_edit"] : null);
                echo "\" target=\"_blank\" class=\"btn btn-primary btn-sm\"><i class=\"fa fa-pencil\"></i></a>
                            <button type=\"button\" onclick=\"\$('#module-row";
                // line 184
                echo (isset($context["module_row"]) ? $context["module_row"] : null);
                echo "').remove();\" data-toggle=\"tooltip\" title=\"";
                echo (isset($context["button_remove"]) ? $context["button_remove"] : null);
                echo "\" class=\"btn btn-danger btn-sm\"><i class=\"fa fa fa-minus-circle\"></i></button>
                          </div>
                        </div></td>
                    </tr>";
                // line 188
                $context["module_row"] = ((isset($context["module_row"]) ? $context["module_row"] : null) + 1);
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['layout_module'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 191
        echo "                  </tbody>
                  <tfoot>
                    <tr>
                      <td class=\"text-left\"><div class=\"input-group\">
                          <select class=\"form-control input-sm\">
                            <option value=\"\"></option>";
        // line 197
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["extensions"]) ? $context["extensions"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["extension"]) {
            // line 198
            echo "                            <optgroup label=\"";
            echo $this->getAttribute($context["extension"], "name", array());
            echo "\">";
            // line 199
            if ( !$this->getAttribute($context["extension"], "module", array())) {
                // line 200
                echo "                            <option value=\"";
                echo $this->getAttribute($context["extension"], "code", array());
                echo "\">";
                echo $this->getAttribute($context["extension"], "name", array());
                echo "</option>";
            } else {
                // line 202
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["extension"], "module", array()));
                foreach ($context['_seq'] as $context["_key"] => $context["module"]) {
                    // line 203
                    echo "                            <option value=\"";
                    echo $this->getAttribute($context["module"], "code", array());
                    echo "\">";
                    echo $this->getAttribute($context["module"], "name", array());
                    echo "</option>";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['module'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
            }
            // line 206
            echo "                            </optgroup>";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['extension'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 208
        echo "                          </select>
                          <div class=\"input-group-btn\">
                            <button type=\"button\" onclick=\"addModule('content-top');\" data-toggle=\"tooltip\" title=\"";
        // line 210
        echo (isset($context["button_module_add"]) ? $context["button_module_add"] : null);
        echo "\" class=\"btn btn-primary btn-sm\"><i class=\"fa fa-plus-circle\"></i></button>
                          </div>
                        </div></td>
                    </tr>
                  </tfoot>
                </table>
                <table id=\"module-content-bottom\" class=\"table table-striped table-bordered table-hover\">
                  <thead>
                    <tr>
                      <td class=\"text-center\">";
        // line 219
        echo (isset($context["text_content_bottom"]) ? $context["text_content_bottom"] : null);
        echo "</td>
                    </tr>
                  </thead>
                  <tbody>";
        // line 223
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["layout_modules"]) ? $context["layout_modules"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["layout_module"]) {
            // line 224
            if (($this->getAttribute($context["layout_module"], "position", array()) == "content_bottom")) {
                // line 225
                echo "                    <tr id=\"module-row";
                echo (isset($context["module_row"]) ? $context["module_row"] : null);
                echo "\">
                      <td class=\"text-left\"><div class=\"input-group\">
                          <select name=\"layout_module[";
                // line 227
                echo (isset($context["module_row"]) ? $context["module_row"] : null);
                echo "][code]\" class=\"form-control input-sm\">";
                // line 228
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable((isset($context["extensions"]) ? $context["extensions"] : null));
                foreach ($context['_seq'] as $context["_key"] => $context["extension"]) {
                    // line 229
                    echo "                            <optgroup label=\"";
                    echo $this->getAttribute($context["extension"], "name", array());
                    echo "\">";
                    // line 230
                    if ( !$this->getAttribute($context["extension"], "module", array())) {
                        // line 231
                        if (($this->getAttribute($context["extension"], "code", array()) == $this->getAttribute($context["layout_module"], "code", array()))) {
                            // line 232
                            echo "                            <option value=\"";
                            echo $this->getAttribute($context["extension"], "code", array());
                            echo "\" selected=\"selected\">";
                            echo $this->getAttribute($context["extension"], "name", array());
                            echo "</option>";
                        } else {
                            // line 234
                            echo "                            <option value=\"";
                            echo $this->getAttribute($context["extension"], "code", array());
                            echo "\">";
                            echo $this->getAttribute($context["extension"], "name", array());
                            echo "</option>";
                        }
                    } else {
                        // line 237
                        $context['_parent'] = $context;
                        $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["extension"], "module", array()));
                        foreach ($context['_seq'] as $context["_key"] => $context["module"]) {
                            // line 238
                            if (($this->getAttribute($context["module"], "code", array()) == $this->getAttribute($context["layout_module"], "code", array()))) {
                                // line 239
                                echo "                            <option value=\"";
                                echo $this->getAttribute($context["module"], "code", array());
                                echo "\" selected=\"selected\">";
                                echo $this->getAttribute($context["module"], "name", array());
                                echo "</option>";
                            } else {
                                // line 241
                                echo "                            <option value=\"";
                                echo $this->getAttribute($context["module"], "code", array());
                                echo "\">";
                                echo $this->getAttribute($context["module"], "name", array());
                                echo "</option>";
                            }
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['module'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                    }
                    // line 245
                    echo "                            </optgroup>";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['extension'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 247
                echo "                          </select>
                          <input type=\"hidden\" name=\"layout_module[";
                // line 248
                echo (isset($context["module_row"]) ? $context["module_row"] : null);
                echo "][position]\" value=\"";
                echo $this->getAttribute($context["layout_module"], "position", array());
                echo "\" />
                          <input type=\"hidden\" name=\"layout_module[";
                // line 249
                echo (isset($context["module_row"]) ? $context["module_row"] : null);
                echo "][sort_order]\" value=\"";
                echo $this->getAttribute($context["layout_module"], "sort_order", array());
                echo "\" />
                          <div class=\"input-group-btn\"><a href=\"";
                // line 250
                echo $this->getAttribute($context["layout_module"], "edit", array());
                echo "\" type=\"button\" data-toggle=\"tooltip\" title=\"";
                echo (isset($context["button_edit"]) ? $context["button_edit"] : null);
                echo "\" target=\"_blank\" class=\"btn btn-primary btn-sm\"><i class=\"fa fa-pencil\"></i></a>
                            <button type=\"button\" onclick=\"\$('#module-row";
                // line 251
                echo (isset($context["module_row"]) ? $context["module_row"] : null);
                echo "').remove();\" data-toggle=\"tooltip\" title=\"";
                echo (isset($context["button_remove"]) ? $context["button_remove"] : null);
                echo "\" class=\"btn btn-danger btn-sm\"><i class=\"fa fa fa-minus-circle\"></i></button>
                          </div>
                        </div></td>
                    </tr>";
                // line 255
                $context["module_row"] = ((isset($context["module_row"]) ? $context["module_row"] : null) + 1);
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['layout_module'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 258
        echo "                  </tbody>
                  <tfoot>
                    <tr>
                      <td class=\"text-left\"><div class=\"input-group\">
                          <select class=\"form-control input-sm\">
                            <option value=\"\"></option>";
        // line 264
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["extensions"]) ? $context["extensions"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["extension"]) {
            // line 265
            echo "                            <optgroup label=\"";
            echo $this->getAttribute($context["extension"], "name", array());
            echo "\">";
            // line 266
            if ( !$this->getAttribute($context["extension"], "module", array())) {
                // line 267
                echo "                            <option value=\"";
                echo $this->getAttribute($context["extension"], "code", array());
                echo "\">";
                echo $this->getAttribute($context["extension"], "name", array());
                echo "</option>";
            } else {
                // line 269
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["extension"], "module", array()));
                foreach ($context['_seq'] as $context["_key"] => $context["module"]) {
                    // line 270
                    echo "                            <option value=\"";
                    echo $this->getAttribute($context["module"], "code", array());
                    echo "\">";
                    echo $this->getAttribute($context["module"], "name", array());
                    echo "</option>";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['module'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
            }
            // line 273
            echo "                            </optgroup>";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['extension'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 275
        echo "                          </select>
                          <div class=\"input-group-btn\">
                            <button type=\"button\" onclick=\"addModule('content-bottom');\" data-toggle=\"tooltip\" title=\"";
        // line 277
        echo (isset($context["button_module_add"]) ? $context["button_module_add"] : null);
        echo "\" class=\"btn btn-primary btn-sm\"><i class=\"fa fa-plus-circle\"></i></button>
                          </div>
                        </div></td>
                    </tr>
                  </tfoot>
                </table>
              </div>
              <div class=\"col-lg-3 col-md-4 col-sm-12\">
                <table id=\"module-column-right\" class=\"table table-striped table-bordered table-hover\">
                  <thead>
                    <tr>
                      <td class=\"text-center\">";
        // line 288
        echo (isset($context["text_column_right"]) ? $context["text_column_right"] : null);
        echo "</td>
                    </tr>
                  </thead>
                  <tbody>";
        // line 292
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["layout_modules"]) ? $context["layout_modules"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["layout_module"]) {
            // line 293
            if (($this->getAttribute($context["layout_module"], "position", array()) == "column_right")) {
                // line 294
                echo "                    <tr id=\"module-row";
                echo (isset($context["module_row"]) ? $context["module_row"] : null);
                echo "\">
                      <td class=\"text-left\"><div class=\"input-group\">
                          <select name=\"layout_module[";
                // line 296
                echo (isset($context["module_row"]) ? $context["module_row"] : null);
                echo "][code]\" class=\"form-control input-sm\">";
                // line 297
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable((isset($context["extensions"]) ? $context["extensions"] : null));
                foreach ($context['_seq'] as $context["_key"] => $context["extension"]) {
                    // line 298
                    echo "                            <optgroup label=\"";
                    echo $this->getAttribute($context["extension"], "name", array());
                    echo "\">";
                    // line 299
                    if ( !$this->getAttribute($context["extension"], "module", array())) {
                        // line 300
                        if (($this->getAttribute($context["extension"], "code", array()) == $this->getAttribute($context["layout_module"], "code", array()))) {
                            // line 301
                            echo "                            <option value=\"";
                            echo $this->getAttribute($context["extension"], "code", array());
                            echo "\" selected=\"selected\">";
                            echo $this->getAttribute($context["extension"], "name", array());
                            echo "</option>";
                        } else {
                            // line 303
                            echo "                            <option value=\"";
                            echo $this->getAttribute($context["extension"], "code", array());
                            echo "\">";
                            echo $this->getAttribute($context["extension"], "name", array());
                            echo "</option>";
                        }
                    } else {
                        // line 306
                        $context['_parent'] = $context;
                        $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["extension"], "module", array()));
                        foreach ($context['_seq'] as $context["_key"] => $context["module"]) {
                            // line 307
                            if (($this->getAttribute($context["module"], "code", array()) == $this->getAttribute($context["layout_module"], "code", array()))) {
                                // line 308
                                echo "                            <option value=\"";
                                echo $this->getAttribute($context["module"], "code", array());
                                echo "\" selected=\"selected\">";
                                echo $this->getAttribute($context["module"], "name", array());
                                echo "</option>";
                            } else {
                                // line 310
                                echo "                            <option value=\"";
                                echo $this->getAttribute($context["module"], "code", array());
                                echo "\">";
                                echo $this->getAttribute($context["module"], "name", array());
                                echo "</option>";
                            }
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['module'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                    }
                    // line 314
                    echo "                            </optgroup>";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['extension'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 316
                echo "                          </select>
                          <input type=\"hidden\" name=\"layout_module[";
                // line 317
                echo (isset($context["module_row"]) ? $context["module_row"] : null);
                echo "][position]\" value=\"";
                echo $this->getAttribute($context["layout_module"], "position", array());
                echo "\" />
                          <input type=\"hidden\" name=\"layout_module[";
                // line 318
                echo (isset($context["module_row"]) ? $context["module_row"] : null);
                echo "][sort_order]\" value=\"";
                echo $this->getAttribute($context["layout_module"], "sort_order", array());
                echo "\" />
                          <div class=\"input-group-btn\"><a href=\"";
                // line 319
                echo $this->getAttribute($context["layout_module"], "edit", array());
                echo "\" data-toggle=\"tooltip\" title=\"";
                echo (isset($context["button_edit"]) ? $context["button_edit"] : null);
                echo "\" target=\"_blank\" class=\"btn btn-primary btn-sm\"><i class=\"fa fa-pencil\"></i></a>
                            <button type=\"button\" onclick=\"\$('#module-row";
                // line 320
                echo (isset($context["module_row"]) ? $context["module_row"] : null);
                echo "').remove();\" data-toggle=\"tooltip\" title=\"";
                echo (isset($context["button_remove"]) ? $context["button_remove"] : null);
                echo "\" class=\"btn btn-danger btn-sm\"><i class=\"fa fa fa-minus-circle\"></i></button>
                          </div>
                        </div></td>
                    </tr>";
                // line 324
                $context["module_row"] = ((isset($context["module_row"]) ? $context["module_row"] : null) + 1);
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['layout_module'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 327
        echo "                  </tbody>
                  <tfoot>
                    <tr>
                      <td class=\"text-left\"><div class=\"input-group\">
                          <select class=\"form-control input-sm\">
                            <option value=\"\"></option>";
        // line 333
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["extensions"]) ? $context["extensions"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["extension"]) {
            // line 334
            echo "                            <optgroup label=\"";
            echo $this->getAttribute($context["extension"], "name", array());
            echo "\">";
            // line 335
            if ( !$this->getAttribute($context["extension"], "module", array())) {
                // line 336
                echo "                            <option value=\"";
                echo $this->getAttribute($context["extension"], "code", array());
                echo "\">";
                echo $this->getAttribute($context["extension"], "name", array());
                echo "</option>";
            } else {
                // line 338
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["extension"], "module", array()));
                foreach ($context['_seq'] as $context["_key"] => $context["module"]) {
                    // line 339
                    echo "                            <option value=\"";
                    echo $this->getAttribute($context["module"], "code", array());
                    echo "\">";
                    echo $this->getAttribute($context["module"], "name", array());
                    echo "</option>";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['module'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
            }
            // line 342
            echo "                            </optgroup>";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['extension'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 344
        echo "                          </select>
                          <div class=\"input-group-btn\">
                            <button type=\"button\" onclick=\"addModule('column-right');\" data-toggle=\"tooltip\" title=\"";
        // line 346
        echo (isset($context["button_module_add"]) ? $context["button_module_add"] : null);
        echo "\" class=\"btn btn-primary btn-sm\"><i class=\"fa fa-plus-circle\"></i></button>
                          </div>
                        </div></td>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </fieldset>
        </form>
      </div>
    </div>
  </div>
  <script type=\"text/javascript\"><!--
var route_row =";
        // line 360
        echo (isset($context["route_row"]) ? $context["route_row"] : null);
        echo ";

function addRoute() {
\thtml  = '<tr id=\"route-row' + route_row + '\">';
\thtml += '  <td class=\"text-left\"><select name=\"layout_route[' + route_row + '][store_id]\" class=\"form-control\">';
\thtml += '  <option value=\"0\">";
        // line 365
        echo (isset($context["text_default"]) ? $context["text_default"] : null);
        echo "</option>';";
        // line 366
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["stores"]) ? $context["stores"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["store"]) {
            // line 367
            echo "\thtml += '<option value=\"";
            echo $this->getAttribute($context["store"], "store_id", array());
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute($context["store"], "name", array()), "js");
            echo "</option>';";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['store'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 369
        echo "\thtml += '  </select></td>';
\thtml += '  <td class=\"text-left\"><input type=\"text\" name=\"layout_route[' + route_row + '][route]\" value=\"\" placeholder=\"";
        // line 370
        echo (isset($context["entry_route"]) ? $context["entry_route"] : null);
        echo "\" class=\"form-control\" /></td>';
\thtml += '  <td class=\"text-left\"><button type=\"button\" onclick=\"\$(\\'#route-row' + route_row + '\\').remove();\" data-toggle=\"tooltip\" title=\"";
        // line 371
        echo (isset($context["button_remove"]) ? $context["button_remove"] : null);
        echo "\" class=\"btn btn-danger\"><i class=\"fa fa-minus-circle\"></i></button></td>';
\thtml += '</tr>';
\t
\t\$('#route tbody').append(html);
\t
\troute_row++;
}

var module_row =";
        // line 379
        echo (isset($context["module_row"]) ? $context["module_row"] : null);
        echo ";

function addModule(type) {
\thtml  = '<tr id=\"module-row' + module_row + '\">';
    html += '  <td class=\"text-left\"><div class=\"input-group\"><select name=\"layout_module[' + module_row + '][code]\" class=\"form-control input-sm\">';";
        // line 384
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["extensions"]) ? $context["extensions"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["extension"]) {
            // line 385
            echo "\thtml += '    <optgroup label=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($context["extension"], "name", array()), "js");
            echo "\">';";
            // line 386
            if ( !$this->getAttribute($context["extension"], "module", array())) {
                // line 387
                echo "\thtml += '      <option value=\"";
                echo $this->getAttribute($context["extension"], "code", array());
                echo "\">";
                echo twig_escape_filter($this->env, $this->getAttribute($context["extension"], "name", array()), "js");
                echo "</option>';";
            } else {
                // line 389
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["extension"], "module", array()));
                foreach ($context['_seq'] as $context["_key"] => $context["module"]) {
                    // line 390
                    echo "\thtml += '      <option value=\"";
                    echo $this->getAttribute($context["module"], "code", array());
                    echo "\">";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["module"], "name", array()), "js");
                    echo "</option>';";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['module'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
            }
            // line 393
            echo "\thtml += '    </optgroup>';";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['extension'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 395
        echo "\thtml += '  </select>';
    html += '  <input type=\"hidden\" name=\"layout_module[' + module_row + '][position]\" value=\"' + type.replace('-', '_') + '\" />';
    html += '  <input type=\"hidden\" name=\"layout_module[' + module_row + '][sort_order]\" value=\"\" />';
\thtml += '  <div class=\"input-group-btn\"><a href=\"\" target=\"_blank\" type=\"button\" data-toggle=\"tooltip\" title=\"";
        // line 398
        echo (isset($context["button_edit"]) ? $context["button_edit"] : null);
        echo "\" class=\"btn btn-primary btn-sm\"><i class=\"fa fa-pencil\"></i></a><button type=\"button\" onclick=\"\$(\\'#module-row' + module_row + '\\').remove();\" data-toggle=\"tooltip\" title=\"";
        echo (isset($context["button_remove"]) ? $context["button_remove"] : null);
        echo "\" class=\"btn btn-danger btn-sm\"><i class=\"fa fa fa-minus-circle\"></i></button></div></div></td>';
\thtml += '</tr>';
\t
\t\$('#module-' + type + ' tbody').append(html);
\t
\t\$('#module-' + type + ' tbody select[name=\\'layout_module[' + module_row + '][code]\\']').val(\$('#module-' + type + ' tfoot select').val());
\t
\t\$('#module-' + type + ' select[name*=\\'code\\']').trigger('change');
\t\t
\t\$('#module-' + type + ' tbody input[name*=\\'sort_order\\']').each(function(i, element) {
\t\t\$(element).val(i);
\t});
\t
\tmodule_row++;
}

\$('#module-column-left, #module-column-right, #module-content-top, #module-content-bottom').delegate('select[name*=\\'code\\']', 'change', function() {
\tvar part = this.value.split('.');
\t
\tif (!part[1]) {
\t\t\$(this).parent().find('a').attr('href', 'index.php?route=extension/module/' + part[0] + '&user_token=";
        // line 418
        echo (isset($context["user_token"]) ? $context["user_token"] : null);
        echo "');
\t} else {
\t\t\$(this).parent().find('a').attr('href', 'index.php?route=extension/module/' + part[0] + '&user_token=";
        // line 420
        echo (isset($context["user_token"]) ? $context["user_token"] : null);
        echo "&module_id=' + part[1]);
\t}
});

\$('#module-column-left, #module-column-right, #module-content-top, #module-content-bottom').trigger('change');
//--></script> 
</div>";
        // line 427
        echo (isset($context["footer"]) ? $context["footer"] : null);
    }

    public function getTemplateName()
    {
        return "design/layout_form.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1062 => 427,  1053 => 420,  1048 => 418,  1023 => 398,  1018 => 395,  1012 => 393,  1001 => 390,  997 => 389,  990 => 387,  988 => 386,  984 => 385,  980 => 384,  973 => 379,  962 => 371,  958 => 370,  955 => 369,  945 => 367,  941 => 366,  938 => 365,  930 => 360,  913 => 346,  909 => 344,  903 => 342,  892 => 339,  888 => 338,  881 => 336,  879 => 335,  875 => 334,  871 => 333,  864 => 327,  857 => 324,  849 => 320,  843 => 319,  837 => 318,  831 => 317,  828 => 316,  822 => 314,  810 => 310,  803 => 308,  801 => 307,  797 => 306,  789 => 303,  782 => 301,  780 => 300,  778 => 299,  774 => 298,  770 => 297,  767 => 296,  761 => 294,  759 => 293,  755 => 292,  749 => 288,  735 => 277,  731 => 275,  725 => 273,  714 => 270,  710 => 269,  703 => 267,  701 => 266,  697 => 265,  693 => 264,  686 => 258,  679 => 255,  671 => 251,  665 => 250,  659 => 249,  653 => 248,  650 => 247,  644 => 245,  632 => 241,  625 => 239,  623 => 238,  619 => 237,  611 => 234,  604 => 232,  602 => 231,  600 => 230,  596 => 229,  592 => 228,  589 => 227,  583 => 225,  581 => 224,  577 => 223,  571 => 219,  559 => 210,  555 => 208,  549 => 206,  538 => 203,  534 => 202,  527 => 200,  525 => 199,  521 => 198,  517 => 197,  510 => 191,  503 => 188,  495 => 184,  489 => 183,  483 => 182,  477 => 181,  474 => 180,  468 => 178,  456 => 174,  449 => 172,  447 => 171,  443 => 170,  435 => 167,  428 => 165,  426 => 164,  424 => 163,  420 => 162,  416 => 161,  413 => 160,  407 => 158,  405 => 157,  401 => 156,  395 => 152,  381 => 141,  377 => 139,  371 => 137,  360 => 134,  356 => 133,  349 => 131,  347 => 130,  343 => 129,  339 => 128,  332 => 122,  325 => 119,  317 => 115,  311 => 114,  305 => 113,  299 => 112,  296 => 111,  290 => 109,  278 => 105,  271 => 103,  269 => 102,  265 => 101,  257 => 98,  250 => 96,  248 => 95,  246 => 94,  242 => 93,  238 => 92,  235 => 91,  229 => 89,  227 => 88,  223 => 87,  217 => 83,  210 => 78,  208 => 77,  205 => 76,  196 => 70,  190 => 66,  184 => 64,  178 => 62,  170 => 61,  167 => 60,  156 => 57,  149 => 55,  147 => 54,  143 => 53,  140 => 52,  136 => 51,  131 => 50,  127 => 49,  125 => 48,  118 => 43,  114 => 42,  107 => 37,  102 => 35,  100 => 34,  95 => 33,  90 => 31,  85 => 29,  80 => 27,  74 => 24,  70 => 22,  63 => 18,  61 => 17,  56 => 13,  46 => 11,  42 => 10,  38 => 8,  32 => 7,  28 => 6,  19 => 1,);
    }
}
/* {{ header }}{{ column_left }}*/
/* <div id="content">*/
/*   <div class="page-header">*/
/*     <div class="container-fluid">*/
/*       <div class="pull-right">*/
/*         <button type="submit" form="form-layout" data-toggle="tooltip" title="{{ button_save }}" class="btn btn-primary"><i class="fa fa-save"></i></button>*/
/*         <a href="{{ cancel }}" data-toggle="tooltip" title="{{ button_cancel }}" class="btn btn-default"><i class="fa fa-reply"></i></a></div>*/
/*       <h1>{{ heading_title }}</h1>*/
/*       <ul class="breadcrumb">*/
/*         {% for breadcrumb in breadcrumbs %}*/
/*         <li><a href="{{ breadcrumb.href }}">{{ breadcrumb.text }}</a></li>*/
/*         {% endfor %}*/
/*       </ul>*/
/*     </div>*/
/*   </div>*/
/*   <div class="container-fluid">*/
/*     {% if error_warning %}*/
/*     <div class="alert alert-danger alert-dismissible"><i class="fa fa-exclamation-circle"></i> {{ error_warning }}*/
/*       <button type="button" class="close" data-dismiss="alert">&times;</button>*/
/*     </div>*/
/*     {% endif %}*/
/*     <div class="panel panel-default">*/
/*       <div class="panel-heading">*/
/*         <h3 class="panel-title"><i class="fa fa-pencil"></i> {{ text_form }}</h3>*/
/*       </div>*/
/*       <div class="panel-body">*/
/*         <form action="{{ action }}" method="post" enctype="multipart/form-data" id="form-layout" class="form-horizontal">*/
/*           <fieldset>*/
/*             <legend>{{ text_route }}</legend>*/
/*             <div class="form-group required">*/
/*               <label class="col-sm-2 control-label" for="input-name">{{ entry_name }}</label>*/
/*               <div class="col-sm-10">*/
/*                 <input type="text" name="name" value="{{ name }}" placeholder="{{ entry_name }}" id="input-name" class="form-control" />*/
/*                 {% if error_name %}*/
/*                 <div class="text-danger">{{ error_name }}</div>*/
/*                 {% endif %}*/
/*               </div>*/
/*             </div>*/
/*             <table id="route" class="table table-striped table-bordered table-hover">*/
/*               <thead>*/
/*                 <tr>*/
/*                   <td class="text-left">{{ entry_store }}</td>*/
/*                   <td class="text-left">{{ entry_route }}</td>*/
/*                   <td></td>*/
/*                 </tr>*/
/*               </thead>*/
/*               <tbody>*/
/*                 {% set route_row = 0 %}*/
/*                 {% for layout_route in layout_routes %}*/
/*                 <tr id="route-row{{ route_row }}">*/
/*                   <td class="text-left"><select name="layout_route[{{ route_row }}][store_id]" class="form-control">*/
/*                       <option value="0">{{ text_default }}</option>*/
/*                       {% for store in stores %}*/
/*                       {% if store.store_id == layout_route.store_id %}*/
/*                       <option value="{{ store.store_id }}" selected="selected">{{ store.name }}</option>*/
/*                       {% else %}*/
/*                       <option value="{{ store.store_id }}">{{ store.name }}</option>*/
/*                       {% endif %}*/
/*                       {% endfor %}*/
/*                     </select></td>*/
/*                   <td class="text-left"><input type="text" name="layout_route[{{ route_row }}][route]" value="{{ layout_route.route }}" placeholder="{{ entry_route }}" class="form-control" /></td>*/
/*                   <td class="text-left"><button type="button" onclick="$('#route-row{{ route_row }}').remove();" data-toggle="tooltip" title="{{ button_remove }}" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>*/
/*                 </tr>*/
/*                 {% set route_row = route_row + 1 %}*/
/*                 {% endfor %}*/
/*               </tbody>*/
/*               <tfoot>*/
/*                 <tr>*/
/*                   <td colspan="2"></td>*/
/*                   <td class="text-left"><button type="button" onclick="addRoute();" data-toggle="tooltip" title="{{ button_route_add }}" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button></td>*/
/*                 </tr>*/
/*               </tfoot>*/
/*             </table>*/
/*           </fieldset>*/
/*           <fieldset>*/
/*             <legend>{{ text_module }}</legend>*/
/*             {% set module_row = 0 %}*/
/*             <div class="row">*/
/*               <div class="col-lg-3 col-md-4 col-sm-12">*/
/*                 <table id="module-column-left" class="table table-striped table-bordered table-hover">*/
/*                   <thead>*/
/*                     <tr>*/
/*                       <td class="text-center">{{ text_column_left }}</td>*/
/*                     </tr>*/
/*                   </thead>*/
/*                   <tbody>*/
/*                     {% for layout_module in layout_modules %}*/
/*                     {% if layout_module.position == 'column_left' %}*/
/*                     <tr id="module-row{{ module_row }}">*/
/*                       <td class="text-left"><div class="input-group">*/
/*                           <select name="layout_module[{{ module_row }}][code]" class="form-control input-sm">*/
/*                             {% for extension in extensions %}*/
/*                             <optgroup label="{{ extension.name }}">*/
/*                             {% if not extension.module %}*/
/*                             {% if extension.code == layout_module.code %}*/
/*                             <option value="{{ extension.code }}" selected="selected">{{ extension.name }}</option>*/
/*                             {% else %}*/
/*                             <option value="{{ extension.code }}">{{ extension.name }}</option>*/
/*                             {% endif %}*/
/*                             {% else %}*/
/*                             {% for module in extension.module %}*/
/*                             {% if module.code == layout_module.code %}*/
/*                             <option value="{{ module.code }}" selected="selected">{{ module.name }}</option>*/
/*                             {% else %}*/
/*                             <option value="{{ module.code }}">{{ module.name }}</option>*/
/*                             {% endif %}*/
/*                             {% endfor %}*/
/*                             {% endif %}*/
/*                             </optgroup>*/
/*                             {% endfor %}*/
/*                           </select>*/
/*                           <input type="hidden" name="layout_module[{{ module_row }}][position]" value="{{ layout_module.position }}" />*/
/*                           <input type="hidden" name="layout_module[{{ module_row }}][sort_order]" value="{{ layout_module.sort_order }}" />*/
/*                           <div class="input-group-btn"><a href="{{ layout_module.edit }}" type="button" data-toggle="tooltip" title="{{ button_edit }}" target="_blank" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>*/
/*                             <button type="button" onclick="$('#module-row{{ module_row }}').remove();" data-toggle="tooltip" title="{{ button_remove }}" class="btn btn-danger btn-sm"><i class="fa fa fa-minus-circle"></i></button>*/
/*                           </div>*/
/*                         </div></td>*/
/*                     </tr>*/
/*                     {% set module_row = module_row + 1 %}*/
/*                     {% endif %}*/
/*                     {% endfor %}*/
/*                   </tbody>*/
/*                   <tfoot>*/
/*                     <tr>*/
/*                       <td class="text-left"><div class="input-group">*/
/*                           <select class="form-control input-sm">*/
/*                             <option value=""></option>*/
/*                             {% for extension in extensions %}*/
/*                             <optgroup label="{{ extension.name }}">*/
/*                             {% if not extension.module %}*/
/*                             <option value="{{ extension.code }}">{{ extension.name }}</option>*/
/*                             {% else %}*/
/*                             {% for module in extension.module %}*/
/*                             <option value="{{ module.code }}">{{ module.name }}</option>*/
/*                             {% endfor %}*/
/*                             {% endif %}*/
/*                             </optgroup>*/
/*                             {% endfor %}*/
/*                           </select>*/
/*                           <div class="input-group-btn">*/
/*                             <button type="button" onclick="addModule('column-left');" data-toggle="tooltip" title="{{ button_module_add }}" class="btn btn-primary btn-sm"><i class="fa fa-plus-circle"></i></button>*/
/*                           </div>*/
/*                         </div></td>*/
/*                     </tr>*/
/*                   </tfoot>*/
/*                 </table>*/
/*               </div>*/
/*               <div class="col-lg-6 col-md-4 col-sm-12">*/
/*                 <table id="module-content-top" class="table table-striped table-bordered table-hover">*/
/*                   <thead>*/
/*                     <tr>*/
/*                       <td class="text-center">{{ text_content_top }}</td>*/
/*                     </tr>*/
/*                   </thead>*/
/*                   <tbody>*/
/*                     {% for layout_module in layout_modules %}*/
/*                     {% if layout_module.position == 'content_top' %}*/
/*                     <tr id="module-row{{ module_row }}">*/
/*                       <td class="text-left"><div class="input-group">*/
/*                           <select name="layout_module[{{ module_row }}][code]" class="form-control input-sm">*/
/*                             {% for extension in extensions %}*/
/*                             <optgroup label="{{ extension.name }}">*/
/*                             {% if not extension.module %}*/
/*                             {% if extension.code == layout_module.code %}*/
/*                             <option value="{{ extension.code }}" selected="selected">{{ extension.name }}</option>*/
/*                             {% else %}*/
/*                             <option value="{{ extension.code }}">{{ extension.name }}</option>*/
/*                             {% endif %}*/
/*                             {% else %}*/
/*                             {% for module in extension.module %}*/
/*                             {% if module.code == layout_module.code %}*/
/*                             <option value="{{ module.code }}" selected="selected">{{ module.name }}</option>*/
/*                             {% else %}*/
/*                             <option value="{{ module.code }}">{{ module.name }}</option>*/
/*                             {% endif %}*/
/*                             {% endfor %}*/
/*                             {% endif %}*/
/*                             </optgroup>*/
/*                             {% endfor %}*/
/*                           </select>*/
/*                           <input type="hidden" name="layout_module[{{ module_row }}][position]" value="{{ layout_module.position }}" />*/
/*                           <input type="hidden" name="layout_module[{{ module_row }}][sort_order]" value="{{ layout_module.sort_order }}" />*/
/*                           <div class="input-group-btn"> <a href="{{ layout_module.edit }}" type="button" data-toggle="tooltip" title="{{ button_edit }}" target="_blank" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>*/
/*                             <button type="button" onclick="$('#module-row{{ module_row }}').remove();" data-toggle="tooltip" title="{{ button_remove }}" class="btn btn-danger btn-sm"><i class="fa fa fa-minus-circle"></i></button>*/
/*                           </div>*/
/*                         </div></td>*/
/*                     </tr>*/
/*                     {% set module_row = module_row + 1 %}*/
/*                     {% endif %}*/
/*                     {% endfor %}*/
/*                   </tbody>*/
/*                   <tfoot>*/
/*                     <tr>*/
/*                       <td class="text-left"><div class="input-group">*/
/*                           <select class="form-control input-sm">*/
/*                             <option value=""></option>*/
/*                             {% for extension in extensions %}*/
/*                             <optgroup label="{{ extension.name }}">*/
/*                             {% if not extension.module %}*/
/*                             <option value="{{ extension.code }}">{{ extension.name }}</option>*/
/*                             {% else %}*/
/*                             {% for module in extension.module %}*/
/*                             <option value="{{ module.code }}">{{ module.name }}</option>*/
/*                             {% endfor %}*/
/*                             {% endif %}*/
/*                             </optgroup>*/
/*                             {% endfor %}*/
/*                           </select>*/
/*                           <div class="input-group-btn">*/
/*                             <button type="button" onclick="addModule('content-top');" data-toggle="tooltip" title="{{ button_module_add }}" class="btn btn-primary btn-sm"><i class="fa fa-plus-circle"></i></button>*/
/*                           </div>*/
/*                         </div></td>*/
/*                     </tr>*/
/*                   </tfoot>*/
/*                 </table>*/
/*                 <table id="module-content-bottom" class="table table-striped table-bordered table-hover">*/
/*                   <thead>*/
/*                     <tr>*/
/*                       <td class="text-center">{{ text_content_bottom }}</td>*/
/*                     </tr>*/
/*                   </thead>*/
/*                   <tbody>*/
/*                     {% for layout_module in layout_modules %}*/
/*                     {% if layout_module.position == 'content_bottom' %}*/
/*                     <tr id="module-row{{ module_row }}">*/
/*                       <td class="text-left"><div class="input-group">*/
/*                           <select name="layout_module[{{ module_row }}][code]" class="form-control input-sm">*/
/*                             {% for extension in extensions %}*/
/*                             <optgroup label="{{ extension.name }}">*/
/*                             {% if not extension.module %}*/
/*                             {% if extension.code == layout_module.code %}*/
/*                             <option value="{{ extension.code }}" selected="selected">{{ extension.name }}</option>*/
/*                             {% else %}*/
/*                             <option value="{{ extension.code }}">{{ extension.name }}</option>*/
/*                             {% endif %}*/
/*                             {% else %}*/
/*                             {% for module in extension.module %}*/
/*                             {% if module.code == layout_module.code %}*/
/*                             <option value="{{ module.code }}" selected="selected">{{ module.name }}</option>*/
/*                             {% else %}*/
/*                             <option value="{{ module.code }}">{{ module.name }}</option>*/
/*                             {% endif %}*/
/*                             {% endfor %}*/
/*                             {% endif %}*/
/*                             </optgroup>*/
/*                             {% endfor %}*/
/*                           </select>*/
/*                           <input type="hidden" name="layout_module[{{ module_row }}][position]" value="{{ layout_module.position }}" />*/
/*                           <input type="hidden" name="layout_module[{{ module_row }}][sort_order]" value="{{ layout_module.sort_order }}" />*/
/*                           <div class="input-group-btn"><a href="{{ layout_module.edit }}" type="button" data-toggle="tooltip" title="{{ button_edit }}" target="_blank" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>*/
/*                             <button type="button" onclick="$('#module-row{{ module_row }}').remove();" data-toggle="tooltip" title="{{ button_remove }}" class="btn btn-danger btn-sm"><i class="fa fa fa-minus-circle"></i></button>*/
/*                           </div>*/
/*                         </div></td>*/
/*                     </tr>*/
/*                     {% set module_row = module_row + 1 %}*/
/*                     {% endif %}*/
/*                     {% endfor %}*/
/*                   </tbody>*/
/*                   <tfoot>*/
/*                     <tr>*/
/*                       <td class="text-left"><div class="input-group">*/
/*                           <select class="form-control input-sm">*/
/*                             <option value=""></option>*/
/*                             {% for extension in extensions %}*/
/*                             <optgroup label="{{ extension.name }}">*/
/*                             {% if not extension.module %}*/
/*                             <option value="{{ extension.code }}">{{ extension.name }}</option>*/
/*                             {% else %}*/
/*                             {% for module in extension.module %}*/
/*                             <option value="{{ module.code }}">{{ module.name }}</option>*/
/*                             {% endfor %}*/
/*                             {% endif %}*/
/*                             </optgroup>*/
/*                             {% endfor %}*/
/*                           </select>*/
/*                           <div class="input-group-btn">*/
/*                             <button type="button" onclick="addModule('content-bottom');" data-toggle="tooltip" title="{{ button_module_add }}" class="btn btn-primary btn-sm"><i class="fa fa-plus-circle"></i></button>*/
/*                           </div>*/
/*                         </div></td>*/
/*                     </tr>*/
/*                   </tfoot>*/
/*                 </table>*/
/*               </div>*/
/*               <div class="col-lg-3 col-md-4 col-sm-12">*/
/*                 <table id="module-column-right" class="table table-striped table-bordered table-hover">*/
/*                   <thead>*/
/*                     <tr>*/
/*                       <td class="text-center">{{ text_column_right }}</td>*/
/*                     </tr>*/
/*                   </thead>*/
/*                   <tbody>*/
/*                     {% for layout_module in layout_modules %}*/
/*                     {% if layout_module.position == 'column_right' %}*/
/*                     <tr id="module-row{{ module_row }}">*/
/*                       <td class="text-left"><div class="input-group">*/
/*                           <select name="layout_module[{{ module_row }}][code]" class="form-control input-sm">*/
/*                             {% for extension in extensions %}*/
/*                             <optgroup label="{{ extension.name }}">*/
/*                             {% if not extension.module %}*/
/*                             {% if extension.code == layout_module.code %}*/
/*                             <option value="{{ extension.code }}" selected="selected">{{ extension.name }}</option>*/
/*                             {% else %}*/
/*                             <option value="{{ extension.code }}">{{ extension.name }}</option>*/
/*                             {% endif %}*/
/*                             {% else %}*/
/*                             {% for module in extension.module %}*/
/*                             {% if module.code == layout_module.code %}*/
/*                             <option value="{{ module.code }}" selected="selected">{{ module.name }}</option>*/
/*                             {% else %}*/
/*                             <option value="{{ module.code }}">{{ module.name }}</option>*/
/*                             {% endif %}*/
/*                             {% endfor %}*/
/*                             {% endif %}*/
/*                             </optgroup>*/
/*                             {% endfor %}*/
/*                           </select>*/
/*                           <input type="hidden" name="layout_module[{{ module_row }}][position]" value="{{ layout_module.position }}" />*/
/*                           <input type="hidden" name="layout_module[{{ module_row }}][sort_order]" value="{{ layout_module.sort_order }}" />*/
/*                           <div class="input-group-btn"><a href="{{ layout_module.edit }}" data-toggle="tooltip" title="{{ button_edit }}" target="_blank" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>*/
/*                             <button type="button" onclick="$('#module-row{{ module_row }}').remove();" data-toggle="tooltip" title="{{ button_remove }}" class="btn btn-danger btn-sm"><i class="fa fa fa-minus-circle"></i></button>*/
/*                           </div>*/
/*                         </div></td>*/
/*                     </tr>*/
/*                     {% set module_row = module_row + 1 %}*/
/*                     {% endif %}*/
/*                     {% endfor %}*/
/*                   </tbody>*/
/*                   <tfoot>*/
/*                     <tr>*/
/*                       <td class="text-left"><div class="input-group">*/
/*                           <select class="form-control input-sm">*/
/*                             <option value=""></option>*/
/*                             {% for extension in extensions %}*/
/*                             <optgroup label="{{ extension.name }}">*/
/*                             {% if not extension.module %}*/
/*                             <option value="{{ extension.code }}">{{ extension.name }}</option>*/
/*                             {% else %}*/
/*                             {% for module in extension.module %}*/
/*                             <option value="{{ module.code }}">{{ module.name }}</option>*/
/*                             {% endfor %}*/
/*                             {% endif %}*/
/*                             </optgroup>*/
/*                             {% endfor %}*/
/*                           </select>*/
/*                           <div class="input-group-btn">*/
/*                             <button type="button" onclick="addModule('column-right');" data-toggle="tooltip" title="{{ button_module_add }}" class="btn btn-primary btn-sm"><i class="fa fa-plus-circle"></i></button>*/
/*                           </div>*/
/*                         </div></td>*/
/*                     </tr>*/
/*                   </tfoot>*/
/*                 </table>*/
/*               </div>*/
/*             </div>*/
/*           </fieldset>*/
/*         </form>*/
/*       </div>*/
/*     </div>*/
/*   </div>*/
/*   <script type="text/javascript"><!--*/
/* var route_row = {{ route_row }};*/
/* */
/* function addRoute() {*/
/* 	html  = '<tr id="route-row' + route_row + '">';*/
/* 	html += '  <td class="text-left"><select name="layout_route[' + route_row + '][store_id]" class="form-control">';*/
/* 	html += '  <option value="0">{{ text_default }}</option>';*/
/* 	{% for store in stores %}*/
/* 	html += '<option value="{{ store.store_id }}">{{ store.name|escape('js') }}</option>';*/
/* 	{% endfor %}*/
/* 	html += '  </select></td>';*/
/* 	html += '  <td class="text-left"><input type="text" name="layout_route[' + route_row + '][route]" value="" placeholder="{{ entry_route }}" class="form-control" /></td>';*/
/* 	html += '  <td class="text-left"><button type="button" onclick="$(\'#route-row' + route_row + '\').remove();" data-toggle="tooltip" title="{{ button_remove }}" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';*/
/* 	html += '</tr>';*/
/* 	*/
/* 	$('#route tbody').append(html);*/
/* 	*/
/* 	route_row++;*/
/* }*/
/* */
/* var module_row = {{ module_row }};*/
/* */
/* function addModule(type) {*/
/* 	html  = '<tr id="module-row' + module_row + '">';*/
/*     html += '  <td class="text-left"><div class="input-group"><select name="layout_module[' + module_row + '][code]" class="form-control input-sm">';*/
/* 	{% for extension in extensions %}*/
/* 	html += '    <optgroup label="{{ extension.name|escape('js') }}">';*/
/* 	{% if not extension.module %}*/
/* 	html += '      <option value="{{ extension.code }}">{{ extension.name|escape('js') }}</option>';*/
/* 	{% else %}*/
/* 	{% for module in extension.module %}*/
/* 	html += '      <option value="{{ module.code }}">{{ module.name|escape('js') }}</option>';*/
/* 	{% endfor %}*/
/* 	{% endif %}*/
/* 	html += '    </optgroup>';*/
/* 	{% endfor %}*/
/* 	html += '  </select>';*/
/*     html += '  <input type="hidden" name="layout_module[' + module_row + '][position]" value="' + type.replace('-', '_') + '" />';*/
/*     html += '  <input type="hidden" name="layout_module[' + module_row + '][sort_order]" value="" />';*/
/* 	html += '  <div class="input-group-btn"><a href="" target="_blank" type="button" data-toggle="tooltip" title="{{ button_edit }}" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a><button type="button" onclick="$(\'#module-row' + module_row + '\').remove();" data-toggle="tooltip" title="{{ button_remove }}" class="btn btn-danger btn-sm"><i class="fa fa fa-minus-circle"></i></button></div></div></td>';*/
/* 	html += '</tr>';*/
/* 	*/
/* 	$('#module-' + type + ' tbody').append(html);*/
/* 	*/
/* 	$('#module-' + type + ' tbody select[name=\'layout_module[' + module_row + '][code]\']').val($('#module-' + type + ' tfoot select').val());*/
/* 	*/
/* 	$('#module-' + type + ' select[name*=\'code\']').trigger('change');*/
/* 		*/
/* 	$('#module-' + type + ' tbody input[name*=\'sort_order\']').each(function(i, element) {*/
/* 		$(element).val(i);*/
/* 	});*/
/* 	*/
/* 	module_row++;*/
/* }*/
/* */
/* $('#module-column-left, #module-column-right, #module-content-top, #module-content-bottom').delegate('select[name*=\'code\']', 'change', function() {*/
/* 	var part = this.value.split('.');*/
/* 	*/
/* 	if (!part[1]) {*/
/* 		$(this).parent().find('a').attr('href', 'index.php?route=extension/module/' + part[0] + '&user_token={{ user_token }}');*/
/* 	} else {*/
/* 		$(this).parent().find('a').attr('href', 'index.php?route=extension/module/' + part[0] + '&user_token={{ user_token }}&module_id=' + part[1]);*/
/* 	}*/
/* });*/
/* */
/* $('#module-column-left, #module-column-right, #module-content-top, #module-content-bottom').trigger('change');*/
/* //--></script> */
/* </div>*/
/* {{ footer }}*/
