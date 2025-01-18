import {Button, Card, Flex, message, Popconfirm, Space, Table} from "antd";
import {PlusCircleFilled} from "@ant-design/icons";
import React, {useEffect, useState} from "react";
import {useNavigate} from "react-router-dom";
import axios from "axios";
import {useAxiosConfig} from "../../services/useAxiosConfig.tsx";

interface Teacher {
    id: number;
    firstName: string;
    lastName: string;
    middleName: string;
}

const TeachersList: React.FC = () => {
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
            title: 'ФИО',
            dataIndex: 'fullName',
            key: 'fullName',
            render: (_text: string, record: Teacher) => (
                <div>
                    {record.lastName} {record.firstName} {record.middleName}
                </div>
            )
        },
        {
            title: 'Действия',
            dataIndex: 'actions',
            key: 'actions',
            render: (_: string, record: Teacher) => (
                <Space size="middle">
                    <a href={`/admin/teachers/${record.id}/view`}>Просмотреть</a>
                    <a href={`/admin/teachers/${record.id}/edit`}>Редактировать</a>
                    <Popconfirm
                        title="Вы уверены, что хотите удалить этого учителя?"
                        onConfirm={() => handleDelete(record.id)}
                        okText="Да"
                        cancelText="Нет"
                    >
                        <a>Удалить</a>
                    </Popconfirm>
                </Space>
            ),
        },
    ];

    const handleClick = () => {
        navigate('/admin/teachers/add'); // укажите здесь путь к нужной странице
    };
    const handleDelete = async (id: number) => {
        try {
            const response = await axiosInstance.delete(`/teachers/${id}`);

            if (response.status === 200) {
                message.success('Учитель успешно удалён');
                // Удаляем учителя из состояния после успешного удаления
                setTeachers((prevTeachers) => prevTeachers.filter((teacher: Teacher) => teacher.id !== id));
            } else {
                message.error(`Ошибка удаления: ${response.statusText}`);
            }
        } catch (error: unknown) {
            console.error(error);
            if (error instanceof Error) {
                message.error(`Ошибка: ${error.message}`);
            } else {
                message.error('Неизвестная ошибка');
            }
        }
    };

    return (
        <Card title='Педагоги'>
            <Flex align='start' vertical gap={"large"}>
                <Button type={"primary"} size={"large"} icon={<PlusCircleFilled/>}
                        onClick={handleClick}>Добавить</Button>
                <Table
                    columns={columns}
                    dataSource={teachers}
                    rowKey={(record) => record.id}
                    style={{width: '100%'}}
                />
            </Flex>
        </Card>
    )


}

export default TeachersList