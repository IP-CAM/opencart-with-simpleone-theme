<?php

/* simpleone/template/common/currency.twig */
class __TwigTemplate_9f56eeaf57a79f08ec260f934c892a262da6e2f9bb00a8f65b8150d51983838e extends Twig_Template
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
        if ((twig_length_filter($this->env, (isset($context["currencies"]) ? $context["currencies"] : null)) > 1)) {
            // line 2
            echo "<div class=\"btn-group\">
  <form action=\"";
            // line 3
            echo (isset($context["action"]) ? $context["action"] : null);
            echo "\" method=\"post\" enctype=\"multipart/form-data\" id=\"form-currency\">
    
      <button class=\"btn btn-default fnt-c so-f-s py-0 dropdown-toggle\" data-toggle=\"dropdown\">";
            // line 5
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["currencies"]) ? $context["currencies"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["currency"]) {
                // line 6
                if (($this->getAttribute($context["currency"], "symbol_left", array()) && ($this->getAttribute($context["currency"], "code", array()) == (isset($context["code"]) ? $context["code"] : null)))) {
                    echo " <strong>";
                    echo $this->getAttribute($context["currency"], "symbol_left", array());
                    echo "</strong>";
                } elseif (($this->getAttribute($context["currency"], "symbol_right", array()) && ($this->getAttribute($context["currency"], "code", array()) == (isset($context["code"]) ? $context["code"] : null)))) {
                    echo " <strong>";
                    echo $this->getAttribute($context["currency"], "symbol_right", array());
                    echo "</strong>";
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['currency'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 7
            echo "</button>
      <ul class=\"dropdown-menu d-h\">";
            // line 9
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["currencies"]) ? $context["currencies"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["currency"]) {
                // line 10
                if ($this->getAttribute($context["currency"], "symbol_left", array())) {
                    // line 11
                    echo "        <li>
          <a class=\"currency-select btn btn-link btn-block\" type=\"button\" name=\"";
                    // line 12
                    echo $this->getAttribute($context["currency"], "code", array());
                    echo "\">";
                    echo $this->getAttribute($context["currency"], "symbol_left", array());
                    echo $this->getAttribute($context["currency"], "title", array());
                    echo "</a>
        </li>";
                } else {
                    // line 15
                    echo "        <li>
          <a class=\"currency-select btn btn-link btn-block\" type=\"button\" name=\"";
                    // line 16
                    echo $this->getAttribute($context["currency"], "code", array());
                    echo "\">";
                    echo $this->getAttribute($context["currency"], "symbol_right", array());
                    echo $this->getAttribute($context["currency"], "title", array());
                    echo "</a>
        </li>";
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['currency'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 20
            echo "      </ul>
   
    <input type=\"hidden\" name=\"code\" value=\"\" />
    <input type=\"hidden\" name=\"redirect\" value=\"";
            // line 23
            echo (isset($context["redirect"]) ? $context["redirect"] : null);
            echo "\" />
  </form>
</div>";
        }
        // line 26
        echo " ";
    }

    public function getTemplateName()
    {
        return "simpleone/template/common/currency.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  93 => 26,  87 => 23,  82 => 20,  70 => 16,  67 => 15,  59 => 12,  56 => 11,  54 => 10,  50 => 9,  47 => 7,  33 => 6,  29 => 5,  24 => 3,  21 => 2,  19 => 1,);
    }
}
/* {% if currencies|length > 1 %}*/
/* <div class="btn-group">*/
/*   <form action="{{ action }}" method="post" enctype="multipart/form-data" id="form-currency">*/
/*     */
/*       <button class="btn btn-default fnt-c so-f-s py-0 dropdown-toggle" data-toggle="dropdown">{% for currency in currencies %}*/
/*       {% if currency.symbol_left and currency.code == code %} <strong>{{ currency.symbol_left }}</strong> {% elseif currency.symbol_right and currency.code == code %} <strong>{{ currency.symbol_right }}</strong> {% endif %}*/
/*       {% endfor %}</button>*/
/*       <ul class="dropdown-menu d-h">*/
/*         {% for currency in currencies %}*/
/*         {% if currency.symbol_left %}*/
/*         <li>*/
/*           <a class="currency-select btn btn-link btn-block" type="button" name="{{ currency.code }}">{{ currency.symbol_left }} {{ currency.title }}</a>*/
/*         </li>*/
/*         {% else %}*/
/*         <li>*/
/*           <a class="currency-select btn btn-link btn-block" type="button" name="{{ currency.code }}">{{ currency.symbol_right }} {{ currency.title }}</a>*/
/*         </li>*/
/*         {% endif %}*/
/*         {% endfor %}*/
/*       </ul>*/
/*    */
/*     <input type="hidden" name="code" value="" />*/
/*     <input type="hidden" name="redirect" value="{{ redirect }}" />*/
/*   </form>*/
/* </div>*/
/* {% endif %} */
