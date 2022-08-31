<?php
/**
 * Task service interface.
 */

namespace App\Service;

use App\Entity\Event;
use Knp\Component\Pager\Pagination\PaginationInterface;

/**
 * Interface EventServiceInterface.
 */
interface EventServiceInterface
{
    /**
     * Get paginated list.
     *
     * @param int         $page Page number
     * @param string|null $name name
     *
     * @return PaginationInterface<string, mixed> Paginated list
     */
    public function getPaginatedList(int $page, ?string $name): PaginationInterface;

    /**
     * Save entity.
     *
     * @param Event $event Event entity
     */
    public function save(Event $event): void;

    /**
     * Can Event be deleted?
     *
     * @param Event $event Event entity
     *
     * @return bool Result
     */
    public function canBeDeleted(Event $event): bool;
}
