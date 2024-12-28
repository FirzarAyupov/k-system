import {Button, Card, Form, Input, message} from "antd";
import {useState} from "react";
import {useAxiosConfig} from "../../services/useAxiosConfig.tsx";
import axios from "axios";


interface TeacherFormValues {
    login: string;
    password: string;
    firstName: string;
    lastName: string;
    patronymic: string;
}

const AddTeacher = () => {
    const config = useAxiosConfig();
    const axiosInstance = axios.create(config);

    const [form] = Form.useForm();
    const [loading, setLoading] = useState(false);

    const onFinish = async (values: TeacherFormValues) => {
        setLoading(true);
        try {
            const response = await axiosInstance.post('/teacher', values);
            const data = await response.data;
            console.log(data)
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
                    rules={[
                        {
                            required: true,
                            message: 'Пожалуйста, введите логин',
                        },
                    ]}
                >
                    <Input/>
                </Form.Item>

                <Form.Item
                    name="password"
                    label="Пароль"
                    rules={[
                        {
                            required: true,
                            message: 'Пожалуйста, введите пароль',
                        },
                    ]}
                >
                    <Input.Password/>
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
                    name="patronymic"
                    label="Отчество"
                    rules={[
                        {
                            required: false,
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
                        Добавить преподавателя
                    </Button>
                </Form.Item>
            </Form>
        </Card>
    );
};

export default AddTeacher