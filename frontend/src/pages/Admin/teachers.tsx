import {Button, Card, Flex, Space, Table, TableProps, Tag} from "antd";
import {PlusCircleFilled} from "@ant-design/icons";
import React, {useEffect, useState} from "react";
import {useNavigate} from "react-router-dom";
import axios from "axios";
import {useAxiosConfig} from "../../services/useAxiosConfig.tsx";


interface DataType {
    key: string;
    name: string;
    age: number;
    address: string;
    tags: string[];
}


const Teachers: React.FC = () => {
    const navigate = useNavigate();
    const config = useAxiosConfig();
    const axiosInstance = axios.create(config);
    const [teachers, setTeachers] = useState([]);

    useEffect(() => {
        axiosInstance.get('/teachers')
            .then(response => {
                console.log(response.data);
                setTeachers(response.data);
            })
            .catch(error => {
                console.error(error);
            });
    }, []);

    const columns = [
        {
            title: 'Id',
            dataIndex: 'id',
            key: 'id',
        }, {
            title: 'Имя',
            dataIndex: 'firstName',
            key: 'firstName',
        },
        {
            title: 'Фамилия',
            dataIndex: 'lastName',
            key: 'lastName',
        },
        {
            title: 'Отчество',
            dataIndex: 'middleName',
            key: 'middleName',
        },
    ];

    const handleClick = () => {
        navigate('/admin/teachers/add'); // укажите здесь путь к нужной странице
    };
    return (
        <Card title='Педагоги'>
            <Flex align='start' vertical gap={"large"}>
                <Button type={"primary"} size={"large"} icon={<PlusCircleFilled/>}
                        onClick={handleClick}>Добавить</Button>
                <Table columns={columns} dataSource={teachers} rowKey={(record) => record.id} style={{width: '100%'}}/>
            </Flex>
        </Card>
    )
}

export default Teachers