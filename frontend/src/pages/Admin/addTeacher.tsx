import {Button, Card, Flex, Form, Input} from "antd";
import React from "react";


const TeachersAdd: React.FC = () => {

    return (
        <Card title='Добавить педагога'>
            <Form
                name="basic"
                autoComplete="off"
            >
                <Flex vertical gap={"large"} style={{'marginBottom': '30px'}}>
                    <Form.Item
                        layout={"vertical"}
                        label={'Email'}
                        rules={[{required: true, message: 'Please input your email!'}]}
                    >
                        <Input placeholder="Email"/>
                    </Form.Item>

                    <Form.Item
                        layout={"vertical"}
                        label={'Пароль'}
                        rules={[{required: true, message: 'Please input your password!'}]}
                    >
                        <Input.Password placeholder="Пароль"/>
                    </Form.Item>
                    <Form.Item style={{textAlign: 'right'}}>
                        <Button type="primary" htmlType="submit">
                            Добавить
                        </Button>
                    </Form.Item>
                </Flex>
            </Form>

        </Card>
    )
}

export default TeachersAdd