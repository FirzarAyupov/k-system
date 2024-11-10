import React, {useState} from 'react';
import {Menu} from 'antd';
import {useLocation, useNavigate} from 'react-router-dom';
import {MenuProps} from 'antd/es/menu';

interface SidebarProps {
    routes: { path: string; label: string; showInMenu: boolean }[];
}

const Sidebar: React.FC<SidebarProps> = ({routes}) => {
    const [stateOpenKeys, setStateOpenKeys] = useState<string[]>([]);  // Состояние для открытых пунктов меню
    const location = useLocation();  // Для отслеживания текущего маршрута
    const navigate = useNavigate();
    const onOpenChange: MenuProps['onOpenChange'] = (openKeys) => {
        setStateOpenKeys(openKeys);
    };

    const onClick: MenuProps['onClick'] = (item) => {
        navigate(item.key);  // Переход на другую страницу по ключу элемента меню
    };

    return (
        <Menu
            mode="inline"
            theme="dark"
            openKeys={stateOpenKeys}
            onOpenChange={onOpenChange}
            onClick={onClick}
            selectedKeys={[location.pathname]}  // Выбираем активный пункт на основе текущего пути
            items={
                routes.filter(route => route.showInMenu).map((route) => ({
                    key: route.path,
                    label: route.label,
                }))
            }
        />
    );
};

export default Sidebar;
