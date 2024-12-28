import {Card, Descriptions, Space, Spin} from "antd";
import {useEffect, useState} from "react";
import {useAxiosConfig} from "../../services/useAxiosConfig.tsx";
import axios from "axios";
import {useParams} from "react-router-dom";

interface TeacherData {
    login: string;
    lastName: string;
    firstName: string;
    middleName: string;
    birthdate: string;
    email: string;
    address: string;
    experience: string;
    category: string;
    lastCertification: string;
    nextCertification: string;
}

const ViewTeacher = () => {
    const {id} = useParams();
    const config = useAxiosConfig();
    const axiosInstance = axios.create(config);

    const [data, setData] = useState<TeacherData | null>(null);
    const [loading, setLoading] = useState(false);

    useEffect(() => {
        axiosInstance.get<TeacherData>(`/teachers/${id}`)
            .then(response => {
                console.log(response.data);
                setData(response.data);
                setLoading(false);
            })
            .catch(error => {
                console.error(error);
                setLoading(false);
            });
    }, []);

    if (loading) {
        return <Spin tip={"Загрузка"}/>
    }


    return (
        <Card>
            <Space direction="vertical" size="large" style={{display: 'flex'}}>
                <Descriptions bordered column={1}>
                    <Descriptions.Item label="Логин">{data?.login}</Descriptions.Item>
                    <Descriptions.Item label="Фамилия">{data?.lastName}</Descriptions.Item>
                    <Descriptions.Item label="Имя">{data?.firstName}</Descriptions.Item>
                    <Descriptions.Item label="Отчество">{data?.middleName}</Descriptions.Item>
                    <Descriptions.Item label="Дата рождения">{data?.birthdate}</Descriptions.Item>
                    <Descriptions.Item label="Email">{data?.email}</Descriptions.Item>
                    <Descriptions.Item label="Адрес">{data?.address}</Descriptions.Item>
                </Descriptions>

                <Descriptions title="Дополнительная информация" bordered column={1}>
                    <Descriptions.Item label="Педстаж">{data?.experience}</Descriptions.Item>
                    <Descriptions.Item label="Категория">{data?.category}</Descriptions.Item>
                    <Descriptions.Item label="Последняя cертификация">{data?.lastCertification}</Descriptions.Item>
                    <Descriptions.Item label="Следующая cертификация">{data?.nextCertification}</Descriptions.Item>
                </Descriptions>
            </Space>
        </Card>
    );
};

export default ViewTeacher