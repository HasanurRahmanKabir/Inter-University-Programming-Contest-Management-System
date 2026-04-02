import AdminLogin from './AdminLogin'
import UserController from './UserController'
import AdminController from './AdminController'
import ContestController from './ContestController'
import TeamController from './TeamController'
import PaymentController from './PaymentController'
import VolunteerController from './VolunteerController'
import NoticeController from './NoticeController'
import RulesAdminController from './RulesAdminController'
import DownloadDetailsController from './DownloadDetailsController'
import GalleryController from './GalleryController'
import KitStatusController from './KitStatusController'
import SponsorController from './SponsorController'
const admin = {
    AdminLogin: Object.assign(AdminLogin, AdminLogin),
UserController: Object.assign(UserController, UserController),
AdminController: Object.assign(AdminController, AdminController),
ContestController: Object.assign(ContestController, ContestController),
TeamController: Object.assign(TeamController, TeamController),
PaymentController: Object.assign(PaymentController, PaymentController),
VolunteerController: Object.assign(VolunteerController, VolunteerController),
NoticeController: Object.assign(NoticeController, NoticeController),
RulesAdminController: Object.assign(RulesAdminController, RulesAdminController),
DownloadDetailsController: Object.assign(DownloadDetailsController, DownloadDetailsController),
GalleryController: Object.assign(GalleryController, GalleryController),
KitStatusController: Object.assign(KitStatusController, KitStatusController),
SponsorController: Object.assign(SponsorController, SponsorController),
}

export default admin