import {Button, Card, Form, Input, message} from "antd";
import {useEffect, useState} from "react";
import {useAxiosConfig} from "../../services/useAxiosConfig.tsx";
import axios from "axios";
import {useNavigate, useParams} from "react-router-dom";


interface TeacherFormValues {
    $login: string;
    $password: string;
    $firstName: string;
    $lastName: string;
    $middleName: string;
}

const EditTeacher = () => {
    const {id} = useParams();
    const config = useAxiosConfig();
    const axiosInstance = axios.create(config);
    const navigate = useNavigate();

    const [form] = Form.useForm();
    const [loading, setLoading] = useState(false);

    useEffect(() => {
        axiosInstance.get(`/teachers/${id}`)
            .then(response => {
                console.log(response.data);
                form.setFieldsValue(response.data);
                setLoading(false);
            })
            .catch(error => {
                console.error(error);
            });
    }, []);

    const onFinish = async (values: TeacherFormValues) => {
        setLoading(true);
        try {
            const dataToSubmit = {...values, id: id}
            await axiosInstance.put('/teacher', dataToSubmit);
            navigate('/admin/teachers');
        } catch (error) {
            message.error('Произошла ошибка при добавлении преподавателя');
            console.error(error);
        } finally {
            setLoading(false);
        }
    };

    return (
        <Card>
            <Form
                form={form}
                layout="vertical"
                onFinish={onFinish}
            >
                <Form.Item
                    name="login"
                    label="Логин"
                >
                    <Input disabled={true}/>
                </Form.Item>

                <Form.Item
                    name="lastName"
                    label="Фамилия"
                    rules={[
                        {
                            required: true,
                            message: 'Пожалуйста, введите фамилию',
                        },
                    ]}
                >
                    <Input/>
                </Form.Item>

                <Form.Item
                    name="firstName"
                    label="Имя"
                    rules={[
                        {
                            required: true,
                            message: 'Пожалуйста, введите имя',
                        },
                    ]}
                >
                    <Input/>
                </Form.Item>

                <Form.Item
                    name="middleName"
                    label="Отчество"
                    rules={[
                        {
                            required: true,
                            message: 'Пожалуйста, введите отчество',
                        },
                    ]}
                >
                    <Input/>
                </Form.Item>

                <Form.Item>
                    <Button
                        type="primary"
                        htmlType="submit"
                        loading={loading}
                    >
                        Сохранить
                    </Button>
                </Form.Item>
            </Form>
        </Card>
    );
};

export default EditTeacher