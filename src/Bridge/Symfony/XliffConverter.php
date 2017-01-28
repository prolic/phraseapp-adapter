<?php

namespace Translation\PlatformAdapter\PhraseApp\Bridge\Symfony;

use Symfony\Component\Translation\MessageCatalogue;
use Translation\SymfonyStorage\Dumper\XliffDumper;
use Translation\SymfonyStorage\Loader\XliffLoader;

/**
 * Utility class to convert between a MessageCatalogue and XLIFF file content.
 * This class can be removed, as soon as https://github.com/symfony/symfony/pull/21442 is merged
 */
final class XliffConverter
{
    /**
     * Create a catalogue from the contents of a XLIFF file.
     *
     * @param string $content
     * @param string $locale
     * @param string $domain
     *
     * @return MessageCatalogue
     */
    public static function contentToCatalogue($content, $locale, $domain)
    {
        $loader = new XliffLoader();
        $catalogue = new MessageCatalogue($locale);
        $loader->extractFromContent($content, $catalogue, $domain);

        return $catalogue;
    }

    /**
     * @param MessageCatalogue $catalogue
     * @param string           $domain
     *
     * @return string
     */
    public static function catalogueToContent(MessageCatalogue $catalogue, $domain)
    {
        $dumper = new XliffDumper();

        return $dumper->getFormattedCatalogue($catalogue, $domain);
    }
}
