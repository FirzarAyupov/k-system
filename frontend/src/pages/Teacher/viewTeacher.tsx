import {Card, Descriptions, Spin} from "antd";
import {useEffect, useState} from "react";
import {useAxiosConfig} from "../../services/useAxiosConfig.tsx";
import axios from "axios";
import {useParams} from "react-router-dom";

interface TeacherData {
    login: string;
    lastName: string;
    firstName: string;
    middleName: string;
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
            <Descriptions title="Детали пользователя" bordered column={1}>
                <Descriptions.Item label="Логин">{data?.login}</Descriptions.Item>
                <Descriptions.Item label="Фамилия">{data?.lastName}</Descriptions.Item>
                <Descriptions.Item label="Имя">{data?.firstName}</Descriptions.Item>
                <Descriptions.Item label="Отчество">{data?.middleName}</Descriptions.Item>
            </Descriptions>
        </Card>
    );
};

export default ViewTeacher