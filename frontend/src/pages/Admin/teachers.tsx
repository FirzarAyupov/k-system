import {Button, Card, Flex, Space, Table, TableProps, Tag} from "antd";
import {PlusCircleFilled} from "@ant-design/icons";
import React from "react";
import {useNavigate} from "react-router-dom";


interface DataType {
    key: string;
    name: string;
    age: number;
    address: string;
    tags: string[];
}

const columns: TableProps<DataType>['columns'] = [
    {
        title: 'ФИО',
        dataIndex: 'name',
        key: 'name',
        render: (text) => <a>{text}</a>,
    },
    {
        title: 'Age',
        dataIndex: 'age',
        key: 'age',
    },
    {
        title: 'Address',
        dataIndex: 'address',
        key: 'address',
    },
    {
        title: 'Tags',
        key: 'tags',
        dataIndex: 'tags',
        render: (_, {tags}) => (
            <>
                {tags.map((tag) => {
                    let color = tag.length > 5 ? 'geekblue' : 'green';
                    if (tag === 'loser') {
                        color = 'volcano';
                    }
                    return (
                        <Tag color={color} key={tag}>
                            {tag.toUpperCase()}
                        </Tag>
                    );
                })}
            </>
        ),
    },
    {
        title: 'Action',
        key: 'action',
        render: (_, record) => (
            <Space size="middle">
                <a>Редактировать</a>
                <a>Удалить</a>
            </Space>
        ),
    },
];

const data: DataType[] = [
    {
        key: '1',
        name: 'John Brown',
        age: 32,
        address: 'New York No. 1 Lake Park',
        tags: ['nice', 'developer'],
    },
    {
        key: '2',
        name: 'Jim Green',
        age: 42,
        address: 'London No. 1 Lake Park',
        tags: ['loser'],
    },
    {
        key: '3',
        name: 'Joe Black',
        age: 32,
        address: 'Sydney No. 1 Lake Park',
        tags: ['cool', 'teacher'],
    },
];

const Teachers: React.FC = () => {
    const navigate = useNavigate();

    const handleClick = () => {
        navigate('/admin/teachers/add'); // укажите здесь путь к нужной странице
    };
    return (
        <Card title='Педагоги'>
            <Flex align='start' vertical gap={"large"}>
                <Button type={"primary"} size={"large"} icon={<PlusCircleFilled/>}
                        onClick={handleClick}>Добавить</Button>
                <Table<DataType> columns={columns} dataSource={data} style={{width: '100%'}}/>
            </Flex>
        </Card>
    )
}

export default Teachers