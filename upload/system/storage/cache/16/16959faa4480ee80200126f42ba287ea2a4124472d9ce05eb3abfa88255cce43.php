<?php

/* simpleone/template/product/category.twig */
class __TwigTemplate_c774b5a6909428f71e8d01a1ced4fd3070a0751944118df89fdb515fe6f5814f extends Twig_Template
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
        echo "
<div id=\"product-category\" class=\"container\">
  <ul class=\"breadcrumb\">";
        // line 4
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["breadcrumbs"]) ? $context["breadcrumbs"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["breadcrumb"]) {
            // line 5
            echo "    <li><a href=\"";
            echo $this->getAttribute($context["breadcrumb"], "href", array());
            echo "\">";
            echo $this->getAttribute($context["breadcrumb"], "text", array());
            echo "</a></li>";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['breadcrumb'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 7
        echo "  </ul>
  <div class=\"row\">";
        // line 8
        echo (isset($context["column_left"]) ? $context["column_left"] : null);
        // line 9
        if (((isset($context["column_left"]) ? $context["column_left"] : null) && (isset($context["column_right"]) ? $context["column_right"] : null))) {
            // line 10
            $context["class"] = "col-sm-6";
        } elseif ((        // line 11
(isset($context["column_left"]) ? $context["column_left"] : null) || (isset($context["column_right"]) ? $context["column_right"] : null))) {
            // line 12
            $context["class"] = "col-sm-9";
        } else {
            // line 14
            $context["class"] = "col-sm-12";
        }
        // line 16
        echo "    <div id=\"content\" class=\"";
        echo (isset($context["class"]) ? $context["class"] : null);
        echo "\">";
        echo (isset($context["content_top"]) ? $context["content_top"] : null);
        echo "
      <h2>";
        // line 17
        echo (isset($context["heading_title"]) ? $context["heading_title"] : null);
        echo "</h2>";
        // line 20
        if ((isset($context["products"]) ? $context["products"] : null)) {
            // line 21
            echo "      <div class=\"row\">
        <div class=\"col-md-2 col-sm-6 hidden-xs\">
          <div class=\"btn-group btn-group-sm\">
            <button type=\"button\" id=\"list-view\" class=\"btn btn-default\" data-toggle=\"tooltip\" title=\"";
            // line 24
            echo (isset($context["button_list"]) ? $context["button_list"] : null);
            echo "\"><i class=\"fa fa-th-list\"></i></button>
            <button type=\"button\" id=\"grid-view\" class=\"btn btn-default\" data-toggle=\"tooltip\" title=\"";
            // line 25
            echo (isset($context["button_grid"]) ? $context["button_grid"] : null);
            echo "\"><i class=\"fa fa-th\"></i></button>
          </div>
        </div>
        <div class=\"col-md-3 col-sm-6\">
          <div class=\"form-group\"><a href=\"";
            // line 29
            echo (isset($context["compare"]) ? $context["compare"] : null);
            echo "\" id=\"compare-total\" class=\"btn btn-default\">";
            echo (isset($context["text_compare"]) ? $context["text_compare"] : null);
            echo "</a></div>
        </div>
        <div class=\"col-md-4 col-xs-6\">
          <div class=\"form-group input-group input-group-sm\">
            <label class=\"input-group-addon\" for=\"input-sort\">";
            // line 33
            echo (isset($context["text_sort"]) ? $context["text_sort"] : null);
            echo "</label>
            <select id=\"input-sort\" class=\"form-control\" onchange=\"location = this.value;\">";
            // line 38
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($context["sorts"]);
            foreach ($context['_seq'] as $context["_key"] => $context["sorts"]) {
                // line 39
                if (($this->getAttribute($context["sorts"], "value", array()) == sprintf("%s-%s", (isset($context["sort"]) ? $context["sort"] : null), (isset($context["order"]) ? $context["order"] : null)))) {
                    // line 40
                    echo "              
              
              
              <option value=\"";
                    // line 43
                    echo $this->getAttribute($context["sorts"], "href", array());
                    echo "\" selected=\"selected\">";
                    echo $this->getAttribute($context["sorts"], "text", array());
                    echo "</option>";
                } else {
                    // line 48
                    echo "              
              
              
              <option value=\"";
                    // line 51
                    echo $this->getAttribute($context["sorts"], "href", array());
                    echo "\">";
                    echo $this->getAttribute($context["sorts"], "text", array());
                    echo "</option>";
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['sorts'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 57
            echo "            
            
            
            </select>
          </div>
        </div>
        <div class=\"col-md-3 col-xs-6\">
          <div class=\"form-group input-group input-group-sm\">
            <label class=\"input-group-addon\" for=\"input-limit\">";
            // line 65
            echo (isset($context["text_limit"]) ? $context["text_limit"] : null);
            echo "</label>
            <select id=\"input-limit\" class=\"form-control\" onchange=\"location = this.value;\">";
            // line 70
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($context["limits"]);
            foreach ($context['_seq'] as $context["_key"] => $context["limits"]) {
                // line 71
                if (($this->getAttribute($context["limits"], "value", array()) == (isset($context["limit"]) ? $context["limit"] : null))) {
                    // line 72
                    echo "              
              
              
              <option value=\"";
                    // line 75
                    echo $this->getAttribute($context["limits"], "href", array());
                    echo "\" selected=\"selected\">";
                    echo $this->getAttribute($context["limits"], "text", array());
                    echo "</option>";
                } else {
                    // line 80
                    echo "              
              
              
              <option value=\"";
                    // line 83
                    echo $this->getAttribute($context["limits"], "href", array());
                    echo "\">";
                    echo $this->getAttribute($context["limits"], "text", array());
                    echo "</option>";
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['limits'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 89
            echo "            
            
            
            </select>
          </div>
        </div>
      </div>
      <div class=\"row\">";
            // line 96
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["products"]) ? $context["products"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["product"]) {
                // line 97
                echo "        <div class=\"product-layout product-list col-xs-12\">
          <div class=\"product-thumb\">
            <div class=\"image m-4\"><a href=\"";
                // line 99
                echo $this->getAttribute($context["product"], "href", array());
                echo "\"><img src=\"";
                echo $this->getAttribute($context["product"], "thumb", array());
                echo "\" alt=\"";
                echo $this->getAttribute($context["product"], "name", array());
                echo "\" title=\"";
                echo $this->getAttribute($context["product"], "name", array());
                echo "\" class=\"img-responsive\" /></a></div>
            <div>
              <div class=\"caption equal\">
                <h4 class=\"fntsize\"><a href=\"";
                // line 102
                echo $this->getAttribute($context["product"], "href", array());
                echo "\">";
                echo $this->getAttribute($context["product"], "name", array());
                echo "</a></h4>
                <p class=\"testt\" style=\"display: none;\">";
                // line 103
                echo $this->getAttribute($context["product"], "description", array());
                echo "</p>";
                // line 104
                if ($this->getAttribute($context["product"], "price", array())) {
                    // line 105
                    echo "                <p class=\"price\">";
                    if ( !$this->getAttribute($context["product"], "special", array())) {
                        // line 106
                        echo $this->getAttribute($context["product"], "price", array());
                    } else {
                        // line 107
                        echo " <span class=\"price-new\">";
                        echo $this->getAttribute($context["product"], "special", array());
                        echo "</span> <span class=\"price-old\">";
                        echo $this->getAttribute($context["product"], "price", array());
                        echo "</span>";
                    }
                    // line 108
                    if ($this->getAttribute($context["product"], "tax", array())) {
                        echo " <span class=\"price-tax\">";
                        echo (isset($context["text_tax"]) ? $context["text_tax"] : null);
                        echo $this->getAttribute($context["product"], "tax", array());
                        echo "</span>";
                    }
                    echo " </p>";
                }
                // line 110
                if ($this->getAttribute($context["product"], "rating", array())) {
                    // line 111
                    echo "                <div class=\"rating\">";
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(range(1, 5));
                    foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                        // line 112
                        if (($this->getAttribute($context["product"], "rating", array()) < $context["i"])) {
                            echo " <span class=\"fa fa-stack\"><i class=\"fa fa-star-o fa-stack-2x\"></i></span>";
                        } else {
                            echo " <span class=\"fa fa-stack\"><i class=\"fa fa-star fa-stack-2x\"></i><i class=\"fa fa-star-o fa-stack-2x\"></i></span>";
                        }
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 113
                    echo " </div>";
                }
                // line 114
                echo " </div>
                 <div class=\"btnpos mt-2\" style=\"text-align: center;\">
          <button type=\"button\" class=\"btn btn-primary btn-lg\" onclick=\"cart.add('";
                // line 116
                echo $this->getAttribute($context["product"], "product_id", array());
                echo "');\"><i class=\"fa fa-shopping-basket\"></i>";
                echo (isset($context["button_cart"]) ? $context["button_cart"] : null);
                echo "</button>
      </div>
      
            </div>
          </div>
        </div>";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['product'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 122
            echo " </div>
      <div class=\"row\">
        <div class=\"col-sm-6 text-left\">";
            // line 124
            echo (isset($context["pagination"]) ? $context["pagination"] : null);
            echo "</div>
        <div class=\"col-sm-6 text-right\">";
            // line 125
            echo (isset($context["results"]) ? $context["results"] : null);
            echo "</div>
      </div>";
        }
        // line 128
        if (( !(isset($context["categories"]) ? $context["categories"] : null) &&  !(isset($context["products"]) ? $context["products"] : null))) {
            // line 129
            echo "      <p>";
            echo (isset($context["text_empty"]) ? $context["text_empty"] : null);
            echo "</p>
      <div class=\"buttons\">
        <div class=\"pull-right\"><a href=\"";
            // line 131
            echo (isset($context["continue"]) ? $context["continue"] : null);
            echo "\" class=\"btn btn-primary\">";
            echo (isset($context["button_continue"]) ? $context["button_continue"] : null);
            echo "</a></div>
      </div>";
        }
        // line 134
        echo (isset($context["content_bottom"]) ? $context["content_bottom"] : null);
        echo "
      <hr>";
        // line 136
        if (((isset($context["thumb"]) ? $context["thumb"] : null) || (isset($context["description"]) ? $context["description"] : null))) {
            // line 137
            echo "      <div class=\"row\">";
            if ((isset($context["thumb"]) ? $context["thumb"] : null)) {
                // line 138
                echo "        <div class=\"col-sm-2\"><img src=\"";
                echo (isset($context["thumb"]) ? $context["thumb"] : null);
                echo "\" alt=\"";
                echo (isset($context["heading_title"]) ? $context["heading_title"] : null);
                echo "\" title=\"";
                echo (isset($context["heading_title"]) ? $context["heading_title"] : null);
                echo "\" class=\"img-thumbnail\" /></div>";
            }
            // line 140
            if ((isset($context["description"]) ? $context["description"] : null)) {
                // line 141
                echo "        <div class=\"col-sm-10\">";
                echo (isset($context["description"]) ? $context["description"] : null);
                echo "</div>";
            }
            // line 142
            echo "</div>";
        }
        // line 145
        echo "      
      </div>";
        // line 147
        echo (isset($context["column_right"]) ? $context["column_right"] : null);
        echo "</div>
</div>
<script src=\"catalog/view/theme/simpleone/js/listviewfix.js\" type=\"text/javascript\"></script>";
        // line 150
        echo (isset($context["footer"]) ? $context["footer"] : null);
        echo " 
";
    }

    public function getTemplateName()
    {
        return "simpleone/template/product/category.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  338 => 150,  333 => 147,  330 => 145,  327 => 142,  322 => 141,  320 => 140,  311 => 138,  308 => 137,  306 => 136,  302 => 134,  295 => 131,  289 => 129,  287 => 128,  282 => 125,  278 => 124,  274 => 122,  260 => 116,  256 => 114,  253 => 113,  243 => 112,  238 => 111,  236 => 110,  227 => 108,  220 => 107,  217 => 106,  214 => 105,  212 => 104,  209 => 103,  203 => 102,  191 => 99,  187 => 97,  183 => 96,  174 => 89,  164 => 83,  159 => 80,  153 => 75,  148 => 72,  146 => 71,  142 => 70,  138 => 65,  128 => 57,  118 => 51,  113 => 48,  107 => 43,  102 => 40,  100 => 39,  96 => 38,  92 => 33,  83 => 29,  76 => 25,  72 => 24,  67 => 21,  65 => 20,  62 => 17,  55 => 16,  52 => 14,  49 => 12,  47 => 11,  45 => 10,  43 => 9,  41 => 8,  38 => 7,  28 => 5,  24 => 4,  19 => 1,);
    }
}
/* {{ header }}*/
/* <div id="product-category" class="container">*/
/*   <ul class="breadcrumb">*/
/*     {% for breadcrumb in breadcrumbs %}*/
/*     <li><a href="{{ breadcrumb.href }}">{{ breadcrumb.text }}</a></li>*/
/*     {% endfor %}*/
/*   </ul>*/
/*   <div class="row">{{ column_left }}*/
/*     {% if column_left and column_right %}*/
/*     {% set class = 'col-sm-6' %}*/
/*     {% elseif column_left or column_right %}*/
/*     {% set class = 'col-sm-9' %}*/
/*     {% else %}*/
/*     {% set class = 'col-sm-12' %}*/
/*     {% endif %}*/
/*     <div id="content" class="{{ class }}">{{ content_top }}*/
/*       <h2>{{ heading_title }}</h2>*/
/*       */
/* */
/*       {% if products %}*/
/*       <div class="row">*/
/*         <div class="col-md-2 col-sm-6 hidden-xs">*/
/*           <div class="btn-group btn-group-sm">*/
/*             <button type="button" id="list-view" class="btn btn-default" data-toggle="tooltip" title="{{ button_list }}"><i class="fa fa-th-list"></i></button>*/
/*             <button type="button" id="grid-view" class="btn btn-default" data-toggle="tooltip" title="{{ button_grid }}"><i class="fa fa-th"></i></button>*/
/*           </div>*/
/*         </div>*/
/*         <div class="col-md-3 col-sm-6">*/
/*           <div class="form-group"><a href="{{ compare }}" id="compare-total" class="btn btn-default">{{ text_compare }}</a></div>*/
/*         </div>*/
/*         <div class="col-md-4 col-xs-6">*/
/*           <div class="form-group input-group input-group-sm">*/
/*             <label class="input-group-addon" for="input-sort">{{ text_sort }}</label>*/
/*             <select id="input-sort" class="form-control" onchange="location = this.value;">*/
/*               */
/*               */
/*               */
/*               {% for sorts in sorts %}*/
/*               {% if sorts.value == '%s-%s'|format(sort, order) %}*/
/*               */
/*               */
/*               */
/*               <option value="{{ sorts.href }}" selected="selected">{{ sorts.text }}</option>*/
/*               */
/*               */
/*               */
/*               {% else %}*/
/*               */
/*               */
/*               */
/*               <option value="{{ sorts.href }}">{{ sorts.text }}</option>*/
/*               */
/*               */
/*               */
/*               {% endif %}*/
/*               {% endfor %}*/
/*             */
/*             */
/*             */
/*             </select>*/
/*           </div>*/
/*         </div>*/
/*         <div class="col-md-3 col-xs-6">*/
/*           <div class="form-group input-group input-group-sm">*/
/*             <label class="input-group-addon" for="input-limit">{{ text_limit }}</label>*/
/*             <select id="input-limit" class="form-control" onchange="location = this.value;">*/
/*               */
/*               */
/*               */
/*               {% for limits in limits %}*/
/*               {% if limits.value == limit %}*/
/*               */
/*               */
/*               */
/*               <option value="{{ limits.href }}" selected="selected">{{ limits.text }}</option>*/
/*               */
/*               */
/*               */
/*               {% else %}*/
/*               */
/*               */
/*               */
/*               <option value="{{ limits.href }}">{{ limits.text }}</option>*/
/*               */
/*               */
/*               */
/*               {% endif %}*/
/*               {% endfor %}*/
/*             */
/*             */
/*             */
/*             </select>*/
/*           </div>*/
/*         </div>*/
/*       </div>*/
/*       <div class="row"> {% for product in products %}*/
/*         <div class="product-layout product-list col-xs-12">*/
/*           <div class="product-thumb">*/
/*             <div class="image m-4"><a href="{{ product.href }}"><img src="{{ product.thumb }}" alt="{{ product.name }}" title="{{ product.name }}" class="img-responsive" /></a></div>*/
/*             <div>*/
/*               <div class="caption equal">*/
/*                 <h4 class="fntsize"><a href="{{ product.href }}">{{ product.name }}</a></h4>*/
/*                 <p class="testt" style="display: none;">{{ product.description }}</p> */
/*                 {% if product.price %}*/
/*                 <p class="price"> {% if not product.special %}*/
/*                   {{ product.price }}*/
/*                   {% else %} <span class="price-new">{{ product.special }}</span> <span class="price-old">{{ product.price }}</span> {% endif %}*/
/*                   {% if product.tax %} <span class="price-tax">{{ text_tax }} {{ product.tax }}</span> {% endif %} </p>*/
/*                 {% endif %}*/
/*                 {% if product.rating %}*/
/*                 <div class="rating"> {% for i in 1..5 %}*/
/*                   {% if product.rating < i %} <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> {% else %} <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span>{% endif %}*/
/*                   {% endfor %} </div>*/
/*                 {% endif %} </div>*/
/*                  <div class="btnpos mt-2" style="text-align: center;">*/
/*           <button type="button" class="btn btn-primary btn-lg" onclick="cart.add('{{ product.product_id }}');"><i class="fa fa-shopping-basket"></i> {{ button_cart }}</button>*/
/*       </div>*/
/*       */
/*             </div>*/
/*           </div>*/
/*         </div>*/
/*         {% endfor %} </div>*/
/*       <div class="row">*/
/*         <div class="col-sm-6 text-left">{{ pagination }}</div>*/
/*         <div class="col-sm-6 text-right">{{ results }}</div>*/
/*       </div>*/
/*       {% endif %}*/
/*       {% if not categories and not products %}*/
/*       <p>{{ text_empty }}</p>*/
/*       <div class="buttons">*/
/*         <div class="pull-right"><a href="{{ continue }}" class="btn btn-primary">{{ button_continue }}</a></div>*/
/*       </div>*/
/*       {% endif %}*/
/*       {{ content_bottom }}*/
/*       <hr>*/
/*       {% if thumb or description %}*/
/*       <div class="row"> {% if thumb %}*/
/*         <div class="col-sm-2"><img src="{{ thumb }}" alt="{{ heading_title }}" title="{{ heading_title }}" class="img-thumbnail" /></div>*/
/*         {% endif %}*/
/*         {% if description %}*/
/*         <div class="col-sm-10">{{ description }}</div>*/
/*         {% endif %}</div>*/
/*       */
/*       {% endif %}*/
/*       */
/*       </div>*/
/*     {{ column_right }}</div>*/
/* </div>*/
/* <script src="catalog/view/theme/simpleone/js/listviewfix.js" type="text/javascript"></script>*/
/* {{ footer }} */
/* */
