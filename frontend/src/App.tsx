import {Route, Routes} from "react-router-dom";
import Login from "./pages/User/Login/login.tsx";
import React from "react";
import Teachers from "./pages/Admin/teachers.tsx";
import TeachersAdd from "./pages/Admin/addTeacher.tsx";
import AuthProvider from "./provider/AuthProvider.tsx";
import {ProtectedRoute} from "./components/ProtectedRoute.tsx";
import MainLayout from "./pages/MainLayout.tsx";

const App: React.FC = () => {

    const routes = [
        { path: "/admin/teachers", label: "Учителя", component: <Teachers />, showInMenu: true },
        { path: "/admin/teachers/add", label: "Добавить учителя", component: <TeachersAdd />, showInMenu: true },
        { path: "/admin/teachers/:id", label: "Учитель по ID", component: <Teachers />, showInMenu: false },
    ];

    return (
        <AuthProvider>
            <Routes>
                <Route path="/login" element={<Login/>}/>
                <Route element={<ProtectedRoute/>}>
                    <Route path="/" element={<MainLayout routes={routes}/>}>
                        {routes.filter(route => route.showInMenu).map((route, index) => (
                            <Route key={index} path={route.path} element={route.component} />
                        ))}
                    </Route>
                </Route>
            </Routes>
        </AuthProvider>
    )
}

export default App
