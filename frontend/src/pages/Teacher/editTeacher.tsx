import {Button, Card, DatePicker, Form, Input, message, Select} from "antd";
import {useEffect, useState} from "react";
import {useAxiosConfig} from "../../services/useAxiosConfig.tsx";
import axios from "axios";
import {useNavigate, useParams} from "react-router-dom";
import locale from "antd/es/date-picker/locale/ru_RU";
import TextArea from "antd/es/input/TextArea";


interface TeacherFormValues {
    $login: string;
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
            <Form form={form} onFinish={onFinish} labelCol={{span: 4}}>

                <Form.Item name="login" label="Логин" wrapperCol={{span: 4}}>
                    <Input disabled={true}/>
                </Form.Item>

                <Form.Item name="lastName" label="Фамилия" wrapperCol={{span: 6}}
                           rules={[
                               {
                                   required: true,
                                   message: 'Пожалуйста, введите фамилию',
                               },
                           ]}
                >
                    <Input/>
                </Form.Item>

                <Form.Item name="firstName" label="Имя" wrapperCol={{span: 6}}
                           rules={[
                               {
                                   required: true,
                                   message: 'Пожалуйста, введите имя',
                               },
                           ]}
                >
                    <Input/>
                </Form.Item>

                <Form.Item name="middleName" label="Отчество" wrapperCol={{span: 6}}
                           rules={[
                               {
                                   required: true,
                                   message: 'Пожалуйста, введите отчество',
                               },
                           ]}
                >
                    <Input/>
                </Form.Item>
                <Form.Item label="Дата рождения" name="birthdate">
                    <DatePicker locale={locale}/>
                </Form.Item>
                <Form.Item label="Email" name="email" wrapperCol={{span: 6}}>
                    <Input type="email"/>
                </Form.Item>
                <Form.Item label="Адрес" name="address" wrapperCol={{span: 6}}>
                    <TextArea autoSize={{minRows: 2}}/>
                </Form.Item>

                <Form.Item label="Педстаж" name="experience" wrapperCol={{span: 4}}>
                    <Input type="number"/>
                </Form.Item>
                <Form.Item label="Категория" name="category" wrapperCol={{span: 4}}>
                    <Select
                        options={[{value: "A", label: "A"}, {value: "B", label: "B"}, {value: "C", label: "C"}]}/>
                </Form.Item>

                <Form.Item label="Последняя cертификация" name="lastCertification">
                    <DatePicker picker="year" locale={locale}/>
                </Form.Item>
                <Form.Item label="Следующая cертификация" name="nextCertification">
                    <DatePicker picker="year" locale={locale}/>
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