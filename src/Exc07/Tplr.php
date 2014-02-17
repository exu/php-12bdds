<?php

namespace Exc07;

class Tplr
{

    public function evaluate($template, $data = [])
    {
        preg_match_all('~\{#([^}]+)\}~', $template, $matches);

        foreach((array) $matches[1] as $key) {
            if (!array_key_exists($key, $data)) {
                throw new \Exception("There is no $key in passed data");
            }
        }


        foreach($data as $key => $value) {
            $template = strtr($template, ["{#{$key}}" => $value]);
        }

        return $template;
    }
}
