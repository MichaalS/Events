<?php
/**
 * Event service.
 */

namespace App\Service;

use App\Entity\Event;
use App\Repository\EventRepository;
use DateTimeImmutable;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;

/**
 * Class EventService.
 */
class EventService implements EventServiceInterface
{
    /**
     * Event repository.
     */
    private EventRepository $eventRepository;

    private EventRepository $EventRepository;

    /**
     * Paginator.
     */
    private PaginatorInterface $paginator;

    /**
     * Constructor.
     *
     * @param EventRepository $EventRepository reposytory
     * @param PaginatorInterface    $paginator             Paginator
     */
    public function __construct(EventRepository $eventRepository, PaginatorInterface $paginator)
    {
        $this->eventRepository = $eventRepository;
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
                $this->eventRepository->queryAll(),
                $page,
                EventRepository::PAGINATOR_ITEMS_PER_PAGE
            );
        }

        return $this->paginator->paginate(
            $this->eventRepository->queryLikeName($name),
            $page,
            EventRepository::PAGINATOR_ITEMS_PER_PAGE
        );
    }

    /**
     * Save entity.
     *
     * @param Event $event Event entity
     */
    public function save(Event $event): void
    {
        if (is_null($event->getId())) {
            $event->setCreatedAt(new DateTimeImmutable());
        }
        $event->setUpdatedAt(new DateTimeImmutable());

        $this->eventRepository->save($event);
    }

    /**
     * Delete event.
     *
     * @param Event $event Event entity
     */
    public function delete(Event $event): void
    {
        $this->eventRepository->delete($event);
    }

    /**
     * Find by id.
     *
     * @param int $id Event id
     *
     * @return Event|null Event entity
     */
    public function findOneById(int $id): ?Event
    {
        return $this->eventRepository->findOneById($id);
    }

    /**
     * Can Event be deleted?
     *
     * @param Event $event Event entity
     *
     * @return bool Result
     */
    public function canBeDeleted(Event $event): bool
    {
        $result = $this->EventRepository->countByEvent($event);

        return !($result > 0);
    }
}
