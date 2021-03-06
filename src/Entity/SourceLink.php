<?php declare(strict_types = 1);

namespace App\Entity;

use League\Uri\Http;
use Psr\Http\Message\UriInterface;

/**
 * Single link on a list
 */
class SourceLink implements \JsonSerializable
{
    /**
     * @var string $id
     */
    private $id;

    /**
     * @var string $url
     */
    private $url;

    /**
     * @var integer $order
     */
    private $order;

    /**
     * @var null|LibraryElement $libraryElement
     */
    private $libraryElement;

    public function __construct(UriInterface $url, LibraryElement $libraryElement)
    {
        $this->url = (string) $url;
        $this->libraryElement = $libraryElement;
    }

    /**
     * @param int $order
     * @return SourceLink
     */
    public function setOrder(int $order): SourceLink
    {
        $this->order = $order;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @return UriInterface
     */
    public function getUrl(): UriInterface
    {
        return Http::createFromString($this->url);
    }

    /**
     * @return int
     */
    public function getOrder(): int
    {
        return $this->order ?? 0;
    }

    /**
     * @return LibraryElement|null
     */
    public function getLibraryElement(): ?LibraryElement
    {
        return $this->libraryElement;
    }

    /**
     * @see \JsonSerializable
     */
    public function jsonSerialize()
    {
        return [
            'id'         => $this->getId() ?? null,
            'url'        => (string) $this->getUrl(),
            'urlEncoded' => base64_encode((string) $this->getUrl()),
            'order'      => $this->getOrder()
        ];
    }
}
