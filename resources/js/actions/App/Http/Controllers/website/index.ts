import WebsiteController from './WebsiteController'
import RegisterInfoController from './RegisterInfoController'
import NoticeInfoController from './NoticeInfoController'
import RulesController from './RulesController'
import CoachController from './CoachController'
import VolunteersController from './VolunteersController'
import TeamRegistrationController from './TeamRegistrationController'
import UserLogin from './UserLogin'
const website = {
    WebsiteController: Object.assign(WebsiteController, WebsiteController),
RegisterInfoController: Object.assign(RegisterInfoController, RegisterInfoController),
NoticeInfoController: Object.assign(NoticeInfoController, NoticeInfoController),
RulesController: Object.assign(RulesController, RulesController),
CoachController: Object.assign(CoachController, CoachController),
VolunteersController: Object.assign(VolunteersController, VolunteersController),
TeamRegistrationController: Object.assign(TeamRegistrationController, TeamRegistrationController),
UserLogin: Object.assign(UserLogin, UserLogin),
}

export default website