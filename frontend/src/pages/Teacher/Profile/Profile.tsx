import React from 'react';
import PersonalData from "./PersonalData.tsx";
import {Space} from "antd";


const Profile: React.FC = () =>
    <Space direction='vertical' style={{display: 'flex'}}>
        <PersonalData/>
        <PersonalData/>
    </Space>

export default Profile;