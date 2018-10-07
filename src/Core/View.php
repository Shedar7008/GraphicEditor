<?php

namespace Shop\Core;


abstract class View
{
    abstract protected function getTemplateName();

    public function applyToMultiple(array $items): string
    {
        $html = '';
        foreach ($items as $item) {
            $html .= $this->apply($item);
        }
        return $html;
    }

    public function apply(Entity $item): string
    {
        $html = $this->getTemplateHtml();

        $repositoryName = $item->getRepositoryName();
        /** @var Repository $repository */
        /** @noinspection PhpUndefinedMethodInspection */
        $repository = $repositoryName::getInstance();

        foreach ($repository->getFields() as $field) {
            $methodName = 'get' . ucfirst($field);
            $value = $item->$methodName();

            $html = str_replace('#' . strtoupper($field) . '#', $value, $html);
        }

        return $html;
    }

    public function fill(array $arr = [], string $html = null): string
    {
        $html = $html ?? $this->getTemplateHtml();

        foreach ($arr as $key => $value) {
            $html = str_replace('#' . strtoupper($key) . '#', $value, $html);
        }

        return $html;
    }

    protected function getTemplateHtml(): string
    {
        return file_get_contents(VIEW_ROOT . $this->getTemplateName() . '.html');
    }

}