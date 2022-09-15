import Dashboard from "../views/App/Dashboard";
import TeamSettings from "../views/App/TeamSettings";
import Plan from "../views/App/Plan";
import UserSettings from "../views/App/User/UserSettings";

// All paths have the prefix /app/.
export const APP_ROUTES = [
    {
        name: "app.home",
        path: "home",
        component: Dashboard,
    },
    {
        name: 'app.team',
        path: "team",
        component: TeamSettings,
    },
    {
        name: 'app.plan',
        path: "plan",
        component: Plan
    },
    {
        name: 'app.user.settings',
        path: "user/settings",
        component: UserSettings,
    }
]