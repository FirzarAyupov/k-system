import {Route, Routes} from "react-router-dom";
import Login from "./pages/User/Login/login.tsx";
import React from "react";
import TeachersList from "./pages/Admin/teachersList.tsx";
import AuthProvider from "./provider/AuthProvider.tsx";
import {ProtectedRoute} from "./components/ProtectedRoute.tsx";
import MainLayout from "./pages/MainLayout.tsx";
import AddTeacher from "./pages/Admin/addTeacher.tsx";
import EditTeacher from "./pages/Admin/editTeacher.tsx";
import ViewTeacher from "./pages/Admin/ViewTeacher.tsx";

const App: React.FC = () => {

    const routes = [
        { path: "/admin/teachers", label: "Учителя", component: <TeachersList />, showInMenu: true },
        { path: "/admin/teachers/add", label: "Добавить учителя", component: <AddTeacher />, showInMenu: true },
        { path: "/admin/teachers/:id/view", label: "Информация", component: <ViewTeacher />, showInMenu: false },
        { path: "/admin/teachers/:id/edit", label: "Редактировать", component: <EditTeacher />, showInMenu: false },
    ];

    return (
        <AuthProvider>
            <Routes>
                <Route path="/login" element={<Login/>}/>
                <Route element={<ProtectedRoute/>}>
                    <Route path="/" element={<MainLayout routes={routes}/>}>
                        {routes.map((route, index) => (
                            <Route key={index} path={route.path} element={route.component} />
                        ))}
                    </Route>
                </Route>
            </Routes>
        </AuthProvider>
    )
}

export default App
