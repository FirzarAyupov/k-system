import {Button, Flex, Form, FormProps, Input, message} from "antd";
import axios from "axios";
import {useNavigate} from "react-router-dom";
import {useAuth} from "../../../provider/AuthProvider.tsx";
import {useEffect} from "react";

type FieldType = {
    email?: string;
    password?: string;
};

const Login = () => {
    const {token, setToken} = useAuth();
    const navigate = useNavigate();

    useEffect(() => {
        if (token) {
            navigate('/admin/teachers/');
        }
    }, [token]);
    const onFinish: FormProps<FieldType>['onFinish'] = async (values) => {
        try {
            const response = await axios.post('http://localhost/api/login_check', {
                username: values.email,
                password: values.password
            });
            const {token} = response.data;
            setToken(token);
            navigate('/admin/teachers/');
        } catch (e) {
            console.error('Ошибка при авторизации', e);
            message.error('Авторизация не удалась')
        }
    };

    const onFinishFailed: FormProps<FieldType>['onFinishFailed'] = (errorInfo) => {
        console.log('Failed:', errorInfo);
    };


    return (
        <Flex style={{height: '100vh'}} align='center' vertical>
            <h1 style={{textAlign: 'center'}}>Авторизация</h1>
            <Form style={{minWidth: 280, maxWidth: '75vw'}}
                  name="basic"
                  onFinish={onFinish}
                  onFinishFailed={onFinishFailed}
                  autoComplete="off"
            >
                <Form.Item<FieldType>
                    name="email"
                    rules={[{required: true, message: 'Please input your email!'}]}
                >
                    <Input placeholder="Email"/>
                </Form.Item>

                <Form.Item<FieldType>
                    name="password"
                    rules={[{required: true, message: 'Please input your password!'}]}
                >
                    <Input.Password placeholder="Пароль"/>
                </Form.Item>

                <Form.Item wrapperCol={{offset: 8, span: 16}}>
                    <Button type="primary" htmlType="submit">
                        Войти
                    </Button>
                </Form.Item>
            </Form>
        </Flex>
    )
}

export default Login