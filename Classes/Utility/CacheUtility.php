<?php
/**
 * Cache Utility
 *
 * @author  Tim Lochmüller
 */

namespace SFC\Staticfilecache\Utility;

use TYPO3\CMS\Core\Cache\CacheManager;
use TYPO3\CMS\Core\Cache\Exception\NoSuchCacheException;
use TYPO3\CMS\Core\Cache\Frontend\FrontendInterface;
use TYPO3\CMS\Extbase\Object\ObjectManager;

/**
 * Cache Utility
 */
class CacheUtility
{

    /**
     * Get the static file cache
     *
     * @return FrontendInterface
     * @throws NoSuchCacheException
     */
    public static function getCache()
    {
        /** @var CacheManager $cacheManager */
        $objectManager = new ObjectManager();
        $cacheManager = $objectManager->get(CacheManager::class);
        return $cacheManager->getCache('staticfilecache');
    }

    /**
     * Clear cache by page ID
     *
     * @param int $pageId
     */
    public static function clearByPageId($pageId)
    {
        $cache = self::getCache();
        $cacheEntries = array_keys($cache->getByTag('pageId_' . (int)$pageId));
        foreach ($cacheEntries as $cacheEntry) {
            $cache->remove($cacheEntry);
        }
    }
}
