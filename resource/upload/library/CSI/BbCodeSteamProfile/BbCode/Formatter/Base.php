<?php namespace CSI\BbCodeSteamProfile\BbCode\Formatter;

/**
 * Class Base
 * @package CSI\BbCodeSteamProfile\BbCode\Formatter
 */
class Base
{
  /**
   * @param array $tag
   * @param array $rendererStates
   * @param \XenForo_BbCode_Formatter_Base $formatter
   * @return mixed
   */
  public static function getBbCodeSteamProfile(array $tag, array $rendererStates, \XenForo_BbCode_Formatter_Base $formatter)
  {
    $xenOptions = \XenForo_Application::get('options');
    $xenVisitor = \XenForo_Visitor::getInstance();
    $tagOption = array_map('trim', explode('|', $tag['option']));

    if (count($tagOption) > 1) {
      $optDefault = $tagOption[0];
    } else {
      $optDefault = $tag['option'];
    }

    $tagContent = $formatter->renderSubTree($tag['children'], $rendererStates);

    if (!preg_match('#^(\w+)$#', $tagContent)) {
      return $formatter->renderInvalidTag($tag, $rendererStates);
    }

    $tagQuery = rawurlencode($tagContent);
    $view = $formatter->getView();

    if ($view) {
      $template = $view->createTemplateObject('csiXF_bbCode_2F43ABC9_tag_steam_profile',
        array(
          'content' => $tagContent,
          'query' => $tagQuery,
        ));

      $tagContent = $template->render();
      return trim($tagContent);
    }

    return $tagContent;
  }
}
