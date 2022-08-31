<?php
/**
 * Task service interface.
 */

namespace App\Service;

use App\Entity\Contact;
use Knp\Component\Pager\Pagination\PaginationInterface;

/**
 * Interface ContactServiceInterface.
 */
interface ContactServiceInterface
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
     * @param Contact $contact Contact entity
     */
    public function save(Contact $contact): void;

    /**
     * Can Contact be deleted?
     *
     * @param Contact $contact Contact entity
     *
     * @return bool Result
     */
    public function canBeDeleted(Contact $contact): bool;
}
