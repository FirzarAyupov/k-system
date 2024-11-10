import {Flex, Layout, Typography} from "antd";
import React from "react";
import Sidebar from "./Sidebar.tsx";
import {Outlet} from "react-router-dom";

const {Header, Footer, Sider, Content} = Layout;
const {Title} = Typography;

const titleStyle: React.CSSProperties = {
    textAlign: 'center',
    color: '#fff',
};

const headerStyle: React.CSSProperties = {
    backgroundColor: '#fff',
    boxShadow: '0 1px 4px rgba(0, 0, 0, 0.08)',
};
const footerStyle: React.CSSProperties = {
    boxShadow: '0 -1px 4px rgba(0, 0, 0, 0.08)',
    backgroundColor: '#fff',
};

const layoutStyle = {
    overflow: 'hidden',
    height: '100vh',
    maxWidth: '100%',
};

interface MainLayoutProps {
    routes: { path: string; label: string; showInMenu: boolean }[];
}

const MainLayout: React.FC<MainLayoutProps> = ({routes}) => {

    return (
        <Flex wrap>
            <Layout style={layoutStyle}>
                <Sider width="20%" theme={'dark'}>
                    <Title level={2} style={titleStyle}>Каенкай</Title>
                    <Sidebar routes={routes}/>
                </Sider>
                <Layout>
                    <Header style={headerStyle}>Header</Header>
                    <Content style={{padding: '20px'}}>
                        <Outlet/>
                    </Content>
                    <Footer style={footerStyle}>Footer</Footer>
                </Layout>
            </Layout>
        </Flex>

    )
}

export default MainLayout
