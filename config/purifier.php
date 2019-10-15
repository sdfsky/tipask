<?php
/**
 * Ok, glad you are here
 * first we get a config instance, and set the settings
 * $config = HTMLPurifier_Config::createDefault();
 * $config->set('Core.Encoding', $this->config->get('purifier.encoding'));
 * $config->set('Cache.SerializerPath', $this->config->get('purifier.cachePath'));
 * if ( ! $this->config->get('purifier.finalize')) {
 *     $config->autoFinalize = false;
 * }
 * $config->loadArray($this->getConfig());
 *
 * You must NOT delete the default settings
 * anything in settings should be compacted with params that needed to instance HTMLPurifier_Config.
 *
 * @link http://htmlpurifier.org/live/configdoc/plain.html
 */

return [

    'encoding'  => 'UTF-8',
    'finalize'  => true,
    'cachePath' => storage_path('app/purifier'),
    'settings'  => [
        'default' => [
            'HTML.Doctype'             => 'HTML 4.01 Transitional',
            'HTML.Allowed'             => 'iframe[src|height|width|class],div,b,font[color|style],strong,i,em,pre,a[href|title|target],ul,ol,li,p[style],br,span[style],img[width|height|alt|src|style|class],table[class|width],td,tr,blockquote,h1,h2,h3,h4,h4,h5',
            'CSS.AllowedProperties'    => 'font,font-size,width,height,font-weight,font-style,font-family,text-decoration,padding-left,color,background-color,text-align',
            'Attr.AllowedFrameTargets' =>'_blank',
            'AutoFormat.AutoParagraph' => true,
            'AutoFormat.RemoveEmpty'   => true,
            "HTML.SafeIframe"      => 'true',
            "URI.SafeIframeRegexp" => "%^(http://|https://|//)(www.youtube.com/embed/|player.youku.com/embed/)%",
        ],
        'custom_definition'=>[
            'id'=>'html5-definitions',
            'rev'=>'1',
            'elements'=>[['video', 'Block', 'Optional: (source, Flow) | (Flow, source) | Flow', 'Common',[
                'src' => 'URI',
                'type' => 'Text',
                'width' => 'Length',
                'height' => 'Length',
                'poster' => 'URI',
                'preload' => 'Enum#auto,metadata,none',
                'controls' => 'Bool',
            ]]],
        ],
        'test'    => [
            'Attr.EnableID' => true
        ],
        "youtube" => [
            "HTML.SafeIframe"      => 'true',
            "URI.SafeIframeRegexp" => "%^(http://|https://|//)(www.youtube.com/embed/|player.vimeo.com/video/)%",
        ],
    ],

];
