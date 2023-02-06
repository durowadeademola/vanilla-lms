<?php

namespace App\Http\Controllers;

use App\Events\AnnouncementCreated;
use App\Events\AnnouncementUpdated;
use App\Events\AnnouncementDeleted;

use App\DataTables\AnnouncementDataTable;
use App\DataTables\lectnStudAnnouncementsDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateAnnouncementRequest;
use App\Http\Requests\UpdateAnnouncementRequest;
use App\Repositories\AnnouncementRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class AnnouncementController extends AppBaseController
{
    /** @var  AnnouncementRepository */
    private $announcementRepository;

    public function __construct(AnnouncementRepository $announcementRepo)
    {
        $this->announcementRepository = $announcementRepo;
    }

    /**
     * Display a listing of the Announcement.
     *
     * @param AnnouncementDataTable $announcementDataTable
     * @return Response
     */
    public function index(AnnouncementDataTable $announcementDataTable)
    {
        return $announcementDataTable->render('announcements.index');
    }

    public function lectnStudAnnouncements(lectnStudAnnouncementsDataTable $lectnStudAnnouncementsDataTable)
    {
        return $lectnStudAnnouncementsDataTable->render('announcements.index');
    }

    /**
     * Show the form for creating a new Announcement.
     *
     * @return Response
     */
    public function create()
    {
        return view('announcements.create');
    }

    /**
     * Store a newly created Announcement in storage.
     *
     * @param CreateAnnouncementRequest $request
     *
     * @return Response
     */
    public function store(CreateAnnouncementRequest $request)
    {
        $input = $request->all();

        $announcement = $this->announcementRepository->create($input);

        Flash::success('Announcement saved successfully.');
        
        AnnouncementCreated::dispatch($announcement);
        return redirect(route('announcements.index'));
    }

    /**
     * Display the specified Announcement.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $announcement = $this->announcementRepository->find($id);

        if (empty($announcement)) {
            Flash::error('Announcement not found');

            return redirect(route('announcements.index'));
        }

        return view('announcements.show')->with('announcement', $announcement);
    }

    /**
     * Show the form for editing the specified Announcement.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $announcement = $this->announcementRepository->find($id);

        if (empty($announcement)) {
            Flash::error('Announcement not found');

            return redirect(route('announcements.index'));
        }

        return view('announcements.edit')->with('announcement', $announcement);
    }

    /**
     * Update the specified Announcement in storage.
     *
     * @param  int              $id
     * @param UpdateAnnouncementRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAnnouncementRequest $request)
    {
        $announcement = $this->announcementRepository->find($id);

        if (empty($announcement)) {
            Flash::error('Announcement not found');

            return redirect(route('announcements.index'));
        }

        $announcement = $this->announcementRepository->update($request->all(), $id);

        Flash::success('Announcement updated successfully.');
        
        AnnouncementUpdated::dispatch($announcement);
        return redirect(route('announcements.index'));
    }

    /**
     * Remove the specified Announcement from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $announcement = $this->announcementRepository->find($id);

        if (empty($announcement)) {
            Flash::error('Announcement not found');

            return redirect(route('announcements.index'));
        }

        $this->announcementRepository->delete($id);

        Flash::success('Announcement deleted successfully.');

        AnnouncementDeleted::dispatch($announcement);
        return redirect(route('announcements.index'));
    }
}
