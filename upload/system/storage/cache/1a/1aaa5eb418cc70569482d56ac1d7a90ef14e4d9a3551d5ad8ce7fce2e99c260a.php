<?php

/* simpleone/template/extension/module/featured.twig */
class __TwigTemplate_f07c6426531c485736f5b72350940b631183fffdcdb46c5ad3c63488cf2e15bf extends Twig_Template
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
        echo "<h3 class=\"linetitle\"><span>";
        echo (isset($context["heading_title"]) ? $context["heading_title"] : null);
        echo "</span></h3>
<div class=\"row\">";
        // line 3
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["products"]) ? $context["products"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["product"]) {
            // line 4
            echo "  <div class=\"product-layout col-lg-3 col-md-3 col-sm-6 col-xs-6\">
    <div class=\"product-thumb transition\">
      <div class=\"image m-4\"><a href=\"";
            // line 6
            echo $this->getAttribute($context["product"], "href", array());
            echo "\"><img src=\"";
            echo $this->getAttribute($context["product"], "thumb", array());
            echo "\" alt=\"";
            echo $this->getAttribute($context["product"], "name", array());
            echo "\" title=\"";
            echo $this->getAttribute($context["product"], "name", array());
            echo "\" class=\"img-responsive\" /></a></div>
      <div class=\"caption equal text-center\">
        <h4><a href=\"";
            // line 8
            echo $this->getAttribute($context["product"], "href", array());
            echo "\">";
            echo $this->getAttribute($context["product"], "name", array());
            echo "</a></h4>";
            // line 9
            if ($this->getAttribute($context["product"], "rating", array())) {
                // line 10
                echo "        <div class=\"rating\">";
                // line 11
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(5);
                foreach ($context['_seq'] as $context["_key"] => $context["i"]) {
                    // line 12
                    if (($this->getAttribute($context["product"], "rating", array()) < $context["i"])) {
                        // line 13
                        echo "          <span class=\"fa fa-stack\"><i class=\"fa fa-star-o fa-stack-2x\"></i></span>";
                    } else {
                        // line 15
                        echo "          <span class=\"fa fa-stack\"><i class=\"fa fa-star fa-stack-2x\"></i><i class=\"fa fa-star-o fa-stack-2x\"></i></span>";
                    }
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['i'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 18
                echo "        </div>";
            }
            // line 20
            if ($this->getAttribute($context["product"], "price", array())) {
                // line 21
                echo "        <div class=\"price-b\">
            <p class=\"price\">";
                // line 23
                if ( !$this->getAttribute($context["product"], "special", array())) {
                    // line 24
                    echo $this->getAttribute($context["product"], "price", array());
                } else {
                    // line 26
                    echo "          <span class=\"price-new\">";
                    echo $this->getAttribute($context["product"], "special", array());
                    echo "</span> <span class=\"price-old\">";
                    echo $this->getAttribute($context["product"], "price", array());
                    echo "</span>
          </p>";
                }
                // line 29
                if ($this->getAttribute($context["product"], "tax", array())) {
                    // line 30
                    echo "          <div class=\"price-tax\">";
                    echo (isset($context["text_tax"]) ? $context["text_tax"] : null);
                    echo $this->getAttribute($context["product"], "tax", array());
                    echo "</div>";
                }
                // line 32
                echo "        </div>";
            }
            // line 34
            echo "      </div>
      <div class=\"text-center\">
         <button type=\"button\" class=\"btn btn-primary btn-lg\" onclick=\"cart.add('";
            // line 36
            echo $this->getAttribute($context["product"], "product_id", array());
            echo "');\"><i class=\"fa fa-shopping-basket\"></i>";
            echo (isset($context["button_cart"]) ? $context["button_cart"] : null);
            echo "</button>
      </div>
    </div>
  </div>";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['product'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 41
        echo "</div>
";
    }

    public function getTemplateName()
    {
        return "simpleone/template/extension/module/featured.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  116 => 41,  104 => 36,  100 => 34,  97 => 32,  91 => 30,  89 => 29,  81 => 26,  78 => 24,  76 => 23,  73 => 21,  71 => 20,  68 => 18,  61 => 15,  58 => 13,  56 => 12,  52 => 11,  50 => 10,  48 => 9,  43 => 8,  32 => 6,  28 => 4,  24 => 3,  19 => 1,);
    }
}
/* <h3 class="linetitle"><span>{{ heading_title }}</span></h3>*/
/* <div class="row">*/
/*  {% for product in products %}*/
/*   <div class="product-layout col-lg-3 col-md-3 col-sm-6 col-xs-6">*/
/*     <div class="product-thumb transition">*/
/*       <div class="image m-4"><a href="{{ product.href }}"><img src="{{ product.thumb }}" alt="{{ product.name }}" title="{{ product.name }}" class="img-responsive" /></a></div>*/
/*       <div class="caption equal text-center">*/
/*         <h4><a href="{{ product.href }}">{{ product.name }}</a></h4>*/
/*         {% if product.rating %}*/
/*         <div class="rating">*/
/*           {% for i in 5 %}*/
/*           {% if product.rating < i %}*/
/*           <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>*/
/*           {% else %}*/
/*           <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span>*/
/*           {% endif %}*/
/*           {% endfor %}*/
/*         </div>*/
/*         {% endif %}*/
/*         {% if product.price %}*/
/*         <div class="price-b">*/
/*             <p class="price">*/
/*           {% if not product.special %}*/
/*           {{ product.price }}*/
/*           {% else %}*/
/*           <span class="price-new">{{ product.special }}</span> <span class="price-old">{{ product.price }}</span>*/
/*           </p>*/
/*           {% endif %}*/
/*           {% if product.tax %}*/
/*           <div class="price-tax">{{ text_tax }} {{ product.tax }}</div>*/
/*           {% endif %}*/
/*         </div>*/
/*         {% endif %}*/
/*       </div>*/
/*       <div class="text-center">*/
/*          <button type="button" class="btn btn-primary btn-lg" onclick="cart.add('{{ product.product_id }}');"><i class="fa fa-shopping-basket"></i> {{ button_cart }}</button>*/
/*       </div>*/
/*     </div>*/
/*   </div>*/
/*   {% endfor %}*/
/* </div>*/
/* */
