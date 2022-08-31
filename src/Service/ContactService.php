<?php
/**
 * Contact service.
 */

namespace App\Service;

use App\Entity\Contact;
use App\Repository\ContactRepository;
use DateTimeImmutable;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;

/**
 * Class ContactService.
 */
class ContactService implements ContactServiceInterface
{
    /**
     * Contact repository.
     */
    private ContactRepository $contactRepository;

    private ContactRepository $ContactRepository;

    /**
     * Paginator.
     */
    private PaginatorInterface $paginator;

    /**
     * Constructor.
     *
     * @param ContactRepository $ContactRepository reposytory
     * @param PaginatorInterface    $paginator             Paginator
     */
    public function __construct(ContactRepository $contactRepository, PaginatorInterface $paginator)
    {
        $this->contactRepository = $contactRepository;
        $this->paginator = $paginator;
    }

    /**
     * Get paginated list.
     *
     * @param int         $page Page number
     * @param string|null $name name
     *
     * @return PaginationInterface<string, mixed> Paginated list
     */
    public function getPaginatedList(int $page, ?string $name = null): PaginationInterface
    {
        if (is_null($name)) {
            return $this->paginator->paginate(
                $this->contactRepository->queryAll(),
                $page,
                ContactRepository::PAGINATOR_ITEMS_PER_PAGE
            );
        }

        return $this->paginator->paginate(
            $this->contactRepository->queryLikeName($name),
            $page,
            ContactRepository::PAGINATOR_ITEMS_PER_PAGE
        );
    }

    /**
     * Save entity.
     *
     * @param Contact $contact Contact entity
     */
    public function save(Contact $contact): void
    {
        if (is_null($contact->getId())) {
            $contact->setCreatedAt(new DateTimeImmutable());
        }
        $contact->setUpdatedAt(new DateTimeImmutable());

        $this->contactRepository->save($contact);
    }

    /**
     * Delete contact.
     *
     * @param Contact $contact Contact entity
     */
    public function delete(Contact $contact): void
    {
        $this->contactRepository->delete($contact);
    }

    /**
     * Find by id.
     *
     * @param int $id Contact id
     *
     * @return Contact|null Contact entity
     */
    public function findOneById(int $id): ?Contact
    {
        return $this->contactRepository->findOneById($id);
    }

    /**
     * Can Contact be deleted?
     *
     * @param Contact $contact Contact entity
     *
     * @return bool Result
     */
    public function canBeDeleted(Contact $contact): bool
    {
        $result = $this->ContactRepository->countByContact($contact);

        return !($result > 0);
    }
}
