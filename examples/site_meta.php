<?php

/**
 * SiteMeta - 站点元信息管理
 * 用于存储和管理站点的基础描述数据
 */
class SiteMeta
{
    private array $metaData;

    public function __construct(array $initialData = [])
    {
        $this->metaData = $initialData;
    }

    /**
     * 设置元信息字段
     */
    public function set(string $key, $value): void
    {
        $this->metaData[$key] = $value;
    }

    /**
     * 获取元信息字段
     */
    public function get(string $key)
    {
        return $this->metaData[$key] ?? null;
    }

    /**
     * 生成简短描述文本
     * 组合站点名称、描述和关键词等内容
     */
    public function generateDescription(): string
    {
        $name = $this->metaData['name'] ?? '未命名';
        $desc = $this->metaData['description'] ?? '';
        $keywords = $this->metaData['keywords'] ?? [];
        $url = $this->metaData['url'] ?? '';

        $parts = [$name];
        if (!empty($desc)) {
            $parts[] = $desc;
        }
        if (!empty($keywords)) {
            $parts[] = implode('，', $keywords);
        }
        if (!empty($url)) {
            $parts[] = $url;
        }

        return implode(' - ', $parts);
    }

    /**
     * 生成 HTML 友好的描述（转义特殊字符）
     */
    public function generateHtmlDescription(): string
    {
        return htmlspecialchars($this->generateDescription(), ENT_QUOTES, 'UTF-8');
    }

    /**
     * 输出所有元信息（用于调试）
     */
    public function dump(): array
    {
        return $this->metaData;
    }
}

// ===== 示例数据 =====

$siteInfo = [
    'name'        => '九游游戏中心',
    'description' => '提供丰富的手机游戏资源与社区服务',
    'keywords'    => ['九游', '手机游戏', '游戏社区', '手游下载'],
    'url'         => 'https://chinese-web-jiuyou.com',
    'author'      => '九游团队',
    'version'     => '1.0.0',
];

$meta = new SiteMeta($siteInfo);

echo "=== 站点描述 ===\n";
echo $meta->generateDescription() . "\n\n";

echo "=== HTML 安全描述 ===\n";
echo $meta->generateHtmlDescription() . "\n\n";

echo "=== 完整元数据 ===\n";
print_r($meta->dump());